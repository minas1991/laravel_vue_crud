<template>
    <div class="p-5">
        <div>
            <div class="form-group mb-4">
                <label for="name">Name *</label>
                <input id="name" maxlength="100" type="text"
                    :class="{'form-control': true, 'is-invalid': !!this.errors.name}" v-model="form.name" />
                <div class="invalid-feedback" v-if="this.errors.name">
                    <div v-for="(msg, i) in this.errors.name" v-bind:key="i">{{ msg }}</div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label>Banners</label>
                <div>
                    <div v-for="banner in banners" :key="banner.id" class="form-check-inline">
                        <label class="btn btn-secondary">
                            {{ banner.name }}
                            <input type="checkbox" :value="banner.id" v-model="form.banners">
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label>Metadata</label>
                <div class="row">
                    <div class="col-6">
                        <div v-for="i in 12" :key="i">
                            <label class="btn btn-default">
                                {{ i - 1 }}:00
                                <input type="checkbox" :value="i-1" v-model="form.metadata" />
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div v-for="i in 12" :key="i">
                            <label class="btn btn-default">
                                {{ i + 11 }}:00
                                <input type="checkbox" :value="i + 11" v-model="form.metadata" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <button type="button" class="btn btn-success px-5" @click="submitForm">Save</button>
            </div>
        </div>
    </div>
</template>

<script>

import CrudApi from '../../services/CrudApi';
const API = new CrudApi('campaigns');

export default {
    name: 'CampaignForm',
    data() {
        return {
            item: null,
            banners: [],
            form: {
                name: '',
                banners: [],
                metadata: []
            },
            errors: []
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        init() {
            if (this.$route.params.id) {
                this.getItem(this.$route.params.id);
            }
            this.getBanners();
        },
        async getItem(id) {
            const response = await API.find(id);

            if (!response.data.data) {
                return this.$router.push('/campaigns/create');
            }

            this.item = response.data.data;
            this.form = {
                name: this.item.name,
                banners: this.item.banners.map(el => el.id),
                metadata: this.getMetadata()
            };
        },
        async submitForm() {
            try {
                if (this.item?.id) {
                    await API.update(this.item?.id, this.form);
                } else {
                    await API.create(this.form);
                }

                return this.$router.push('/campaigns');
            } catch (error) {
                if (error.response?.status === 422) {
                    this.errors = error.response.data.errors;
                }

                return false;
            }
            
        },
        async getBanners() {
            const API = new CrudApi('banners');
            const response = await API.all();
            this.banners = response.data.data;
        },
        getMetadata() {
            let data = [];
            for (let el of this.item.metadata) {
                const s = el.start_time.split(':')[0];
                const e = el.end_time.split(':')[0];

                if (e - s < 1) {
                    data.push(s);
                } else {
                    for (let i = s; i <= e; i++) {
                        data.push(i);
                    }
                }
            }

            return data;
        }
    }
}

</script>
