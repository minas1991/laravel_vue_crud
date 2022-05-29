import axios from 'axios';

export default class CrudApi
{
    constructor(resource)
    {
        this.resource = resource;
    }

    async all() {
        return await axios.get(this.resource);
    }

    async find(id) {
        return await axios.get(this.resource + '/' + id);
    }

    async create(data) {
        return await axios.post(this.resource, data);
    }

    async update(id, data) {
        return await axios.put(this.resource + '/' + id, data);
    }

    async delete(id) {
        return await axios.delete(this.resource + '/' + id);
    }
}
