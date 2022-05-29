import VueRouter from 'vue-router';

import Index from '../components/Index.vue';
import BannerIndex from '../components/Banner/Index.vue';
import BannerForm from '../components/Banner/Form';
import CampaignIndex from '../components/Campaign/Index';
import CampaignForm from '../components/Campaign/Form';

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Index
    },
    {
        name: 'Banners',
        path: '/banners',
        component: BannerIndex
    },
    {
        name: 'BannerCreate',
        path: '/banners/create',
        component: BannerForm
    },
    {
        name: 'BannerEdit',
        path: '/banners/edit/:id',
        component: BannerForm
    },
    {
        name: 'Campaigns',
        path: '/campaigns',
        component: CampaignIndex
    },
    {
        name: 'CampaignCreate',
        path: '/campaigns/create',
        component: CampaignForm
    },
    {
        name: 'CampaignEdit',
        path: '/campaigns/edit/:id',
        component: CampaignForm
    },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});


export default router;
