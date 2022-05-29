<template>
    <div>
        <div class="row">
            <div class="col-7">
                <h1>Banners List</h1>
            </div>
            <div class="col-5">
                <div style="text-align: right">
                    <router-link to="/banners/create" class="btn btn-primary px-5">Create Banner</router-link>
                </div>    
            </div>
        </div>
        <hr>

        <div v-if="showTable">
            <table class="table" v-if="items.length">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Text</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.text }}</td>
                        <td nowrap>
                            <router-link class="btn btn-info" :to="{name: 'BannerEdit', params: { id: item.id }}">Edit</router-link>
                            <button type="button" @click="deleteAction(item.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else style="text-align: center">
                <p class="h2">No Result</p>
            </div>
        </div>
    </div>
</template>

<script>

import CrudApi from '../../services/CrudApi';
const API = new CrudApi('banners');

export default {
    name: 'BannerIndex',
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