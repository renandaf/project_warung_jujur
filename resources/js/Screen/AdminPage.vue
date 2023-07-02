<template>
    <side-bar admin="active"></side-bar>
    <br /><br />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>HALAMAN ADMIN</h4>
                        <hr />
                        <div class="row">
                            <div class="col-1 gx-5 mr-4">
                                <router-link
                                    to="/admin/dagangan"
                                    class="btn btn-success"
                                    >Dagangan</router-link
                                >
                            </div>
                            <div class="col-1 gx-5 ml-4">
                                <router-link
                                    to="/admin/preorder"
                                    class="btn btn-info"
                                    >Preorder</router-link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
