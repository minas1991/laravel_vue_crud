<template>
    <div>
        <div class="row">
            <div class="col-7">
                <h1>Campaigns List</h1>
            </div>
            <div class="col-5">
                <div style="text-align: right">
                    <router-link to="/campaigns/create" class="btn btn-primary px-5">Create Campaign</router-link>
                </div>    
            </div>
        </div>
        <hr>

        <div  v-if="showTable">
            <table class="table" v-if="items.length">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Banners</th>
                        <th>Metadata</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>
                            <div v-for="banner in item.banners" :key="banner.id">{{ banner.name }}</div>
                        </td>
                        <td nowrap>
                            <div v-for="meta in item.metadata" :key="meta.id">
                                {{ meta.start_time }} - {{ meta.end_time }}
                            </div>
                        </td>
                        <td>
                            <span :class="{'text-success': item.status === 'Active'}">
                                {{ item.status }}
                            </span>
                        </td>
                        <td nowrap>
                            <router-link class="btn btn-info" :to="{name: 'CampaignEdit', params: { id: item.id }}">Edit</router-link>
                            <button type="button" @click="deleteAction(item.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <p class="h2">No Result</p>
            </div>
        </div>
    </div>
</template>

<script>

import CrudApi from '../../services/CrudApi';
const API = new CrudApi('campaigns');

export default {
    name: 'CampaignIndex',
    data() {
        return {
            items: [],
            showTable: false
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        async init() {
            await this.getItems();
            this.showTable = true;
        },
        async getItems() {
            const response = await API.all();
            this.items = response.data.data;
        },
        async deleteAction(id) {
            if (confirm('Want to delete?') === true) {
                try {
                    await API.delete(id);
                    this.items = this.items.filter(el => el.id !== id);
                } catch(error) {
                    alert('Failed to delete item');
                }
            }
        }
    }
}

</script>