<template>
    <div class="p-5">
        <div class="row">
            <div class="col-md-6">
                <div class="p-5">
                    <router-link to="/banners">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="h1 py-5 text-center">
                                    Banners
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5">
                    <router-link to="/campaigns">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="h1 py-5 text-center">
                                    Campaigns
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Index'
}

</script>