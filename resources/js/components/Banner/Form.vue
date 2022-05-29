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
                <label for="text">Text *</label>
                <textarea id="text" maxlength="1000"
                    :class="{'form-control': true, 'is-invalid': !!this.errors.text}" rows="5" v-model="form.text"></textarea>
                <div class="invalid-feedback" v-if="this.errors.text">
                    <div v-for="(msg, i) in this.errors.text" v-bind:key="i">{{ msg }}</div>
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
const API = new CrudApi('banners');

export default {
    name: 'BannerForm',
    data() {
        return {
            item: null,
            form: {},
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
        },
        async getItem(id) {
            const response = await API.find(id);

            if (!response.data.data) {
                return this.$router.push('/banners/create');
            }

            this.item = response.data.data;
            this.form = {name: this.item.name, text: this.item.text};
        },
        async submitForm() {
            try {
                if (this.item?.id) {
                    await API.update(this.item?.id, this.form);
                } else {
                    await API.create(this.form);
                }

                return this.$router.push('/banners');
            } catch (error) {
                console.log(error);
                if (error.response?.status === 422) {
                    this.errors = error.response.data.errors;
                }

                return false;
            }
            
        }
    }
}

</script>