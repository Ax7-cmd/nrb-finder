<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Trp List
                                <br>
                                <small class="text-info align-left">Data Penarikan trp yang di upload harus sudah sesuai dengan
                                    tabel terlampir</small>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-info" @click="newModal">
                                    <i class="fa fa-file-import"></i>
                                    Import
                                </button>
                                <button type="button" class="btn btn-success" @click="exportData">
                                    <i class="fa fa-file-excel"></i>
                                    Export
                                </button>
                                <br><br>
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <input v-model="query.search" type="text" name="table_search"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default" @click="handleSearch">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 440px;" @scroll="handleScroll">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No. Nrb</th>
                                        <th>No. Draft</th>
                                        <th>Branch</th>
                                        <th>Dir</th>
                                        <th>Driver</th>
                                        <th>Tanggal Tarik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="trpData in data" :key="trpData.no_faktur">
                                        <td>{{trpData.no_faktur}}</td>
                                        <td>{{trpData.no_draf_retur}}</td>
                                        <td>{{trpData.branch}}</td>
                                        <td>{{trpData.dir}}</td>
                                        <td>{{trpData.driver}}</td>
                                        <td>{{trpData.tgl_tarik}}</td>
                                    </tr>
                                </tbody>
                                <tfoot v-if="query.more">
                                    <tr>
                                        <td colspan="4">Getting Data, Please wait..</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Import Data Transportation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="importData()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>File</label>
                                    <input type="file" id="file" ref="file" class="form-control"
                                        v-on:change="handleFileUpload()" v-bind:class="invalid" />
                                    <div class="help-block invalid-feedback">{{ errors.file[0] }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        components: {},
        data() {
            return {
                data: [],
                query: {
                    more: true,
                    skip: 0,
                    take: 20,
                    search: '',
                },
                import: '',
                errorStatus: '',
                errors: {
                    file: [],
                },
            }
        },
        methods: {
            loadData() {
                axios.get("api/trp", {
                    params: this.query
                }).then((response) => {
                    const combinedA = [].concat(this.data, response.data.data);
                    this.data = combinedA;
                    this.query = response.data.message;
                });
            },
            handleScroll: function (e) {
                if (parseInt(e.srcElement.scrollHeight - e.srcElement.scrollTop) == parseInt(e.srcElement.clientHeight)) {
                    if (this.query.more) {
                        this.query.skip = this.query.skip + this.query.take;
                        this.loadData();
                    }
                }
            },
            newModal() {
                this.$refs.file.value = null;
                this.errorStatus = '';
                $('#addNew').modal('show');
            },
            importData() {
                this.$Progress.start();
                let formData = new FormData();
                formData.append('file', this.import);
                axios.post('api/trp',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then((data) => {
                        if (data.data.success) {
                            $('#addNew').modal('hide');
                            Toast.fire({
                                icon: 'success',
                                title: data.data.message
                            });
                            this.$Progress.finish();
                            this.loadData();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Some error occured! Please try again'
                            });
                            this.$Progress.finish();
                        }
                    })
                    .catch((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                        if (error.response.data.errors != undefined) {
                            this.errorStatus = 'is-invalid';
                            this.errors.file = error.response.data.errors.file;
                        } else {
                            $('#addNew').modal('hide');
                        }
                        this.$Progress.finish();
                    });
            },
            exportData() {
                let routeData = this.$router.resolve({
                    path: '/export-trp?search=' + this.query.search
                });
                window.open(routeData.href, '_blank');
            },
            handleFileUpload() {
                this.import = this.$refs.file.files[0];
            },
            handleSearch() {
                this.data = [];
                this.query.more = true;
                this.query.skip = 0;
                this.loadData();
            },
        },
        mounted() {},
        created() {
            this.$Progress.start();
            this.loadData();
            this.$Progress.finish();
        },
        filters: {},
        computed: {
            invalid: function () {
                return this.errorStatus;
            }
        },
    }

</script>
