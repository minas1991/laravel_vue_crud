<template>
    <main>
        <div class="dashboard">
            <div id="sidebar">
                <ul class="sidebar-nav mt-5">
                    <li>
                        <router-link to="/">Main</router-link>
                    </li>
                    <li>
                        <router-link to="/banners">Banners</router-link>
                    </li>
                    <li>
                        <router-link to="/campaigns">Campaigns</router-link>
                    </li>
                </ul>
            </div>
            <div id="page_content">
                <div class="p-5">
                    <router-view />
                </div>
            </div>
        </div>
    </main>
</template>

<script>

export default {
    name: 'App'
}

</script>
