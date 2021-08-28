<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="card-title">
                                        List NRB Yang Akan Di Export
                                    </h3>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success" @click="exportData">
                                        <i class="fa fa-file-excel"></i>
                                        Export
                                    </button>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group p-0 m-0">
                                                <select class="form-control" v-model="query.selectarea">
                                                    <option value="">Select Area</option>    
                                                    <option v-for="option in options" v-bind:value="option.value">
                                                        {{ option.text }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group p-0 m-0">
                                                <div class="input-group">
                                                    <input type="text" v-model="query.datefrom" class="form-control"
                                                        v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" v-model="query.dateto" class="form-control"
                                                        v-mask="'####-##-##'" placeholder="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-info" @click="handleFilter">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm">
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
                            <div class="row pt-3">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" v-model="query.checksudah" true-value="true" false-value="false"
                                                    class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Sudah
                                                    Ditarik</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" v-model="query.checkbelum" true-value="true" false-value="false"
                                                    class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Belum
                                                    Ditarik</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 440px;" @scroll="handleScroll">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Tgl Retur</th>
                                        <th>No. RTV</th>
                                        <th>No. Draft</th>
                                        <th>Branch</th>
                                        <th>Amount (Rp.)</th>
                                        <th>Dir</th>
                                        <th>Tanggal Tarik</th>
                                        <th>Ekspedisi</th>
                                        <th>No. TTRS</th>
                                        <th>Tanggal TTRS</th>
                                        <th>No. RMA</th>
                                        <th>Tanggal RMA</th>
                                        <th>No. CN</th>
                                        <th>Tanggal CN </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="nrbData in data" :key="nrbData.no_faktur">
                                        <td>{{nrbData.tgl_retur}}</td>
                                        <td>{{nrbData.no_nrb}}</td>
                                        <td>{{nrbData.no_draft}}</td>
                                        <td>{{nrbData.branch}}</td>
                                        <td>{{ nrbData.amount | numberFormat }}</td>
                                        <td>{{nrbData.dir}}</td>
                                        <td>{{nrbData.tgl_tarik}}</td>
                                        <td>{{nrbData.driver}}</td>
                                        <td>{{nrbData.no_ttrs}}</td>
                                        <td>{{nrbData.tgl_ttrs}}</td>
                                        <td>{{nrbData.no_rma}}</td>
                                        <td>{{nrbData.tgl_rma}}</td>
                                        <td>{{nrbData.no_cn}}</td>
                                        <td>{{nrbData.tgl_cn}}</td>
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
                            <h5 class="modal-title">Import NRB</h5>
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
                    filters: false,
                    selectarea: '',
                    datefrom: '',
                    dateto: '',
                    checkbelum: false,
                    checksudah: false,
                    more: true,
                    skip: 0,
                    take: 20,
                    search: '',
                },
                options: [{
                        text: 'Bekasi',
                        value: 'Bekasi'
                    },
                    {
                        text: 'Balaraja',
                        value: 'Balaraja'
                    },
                    {
                        text: 'Bogor',
                        value: 'Bogor'
                    },
                    {
                        text: 'Cikokol',
                        value: 'Cikokol'
                    },
                    {
                        text: 'Cileungsi_2',
                        value: 'Cileungsi_2'
                    },
                    {
                        text: 'Karawang',
                        value: 'Karawang'
                    }
                ],
                import: '',
                errorStatus: '',
                errors: {
                    file: [],
                },
            }
        },
        methods: {
            loadData() {
                axios.get("api/fin", {
                    params: this.query
                }).then((response) => {
                    const combinedA = [].concat(this.data, response.data.data);
                    this.data = combinedA;
                    this.query = response.data.message;
                });
            },
            handleScroll: function (e) {
                if (parseInt(e.srcElement.scrollHeight - e.srcElement.scrollTop) == parseInt(e.srcElement
                        .clientHeight)-1) {
                    if (this.query.more) {
                        this.query.skip = this.query.skip + this.query.take;
                        this.loadData();
                    }
                }
            },
            handleFilter() {
                this.query.filters=true;
                this.data = [];
                this.query.more = true;
                this.query.skip = 0;
                this.loadData();
                console.log(this.query.selectarea);
                console.log(this.query.datefrom);
                console.log(this.query.dateto);
                console.log(this.query.checkbelum);
                console.log(this.query.checksudah);
            },
            exportData() {
                let routeData = this.$router.resolve({
                    path: '/export-fin?search=' + this.query.search + '&filters=' + this.query.filters + '&selectarea=' + this.query.selectarea +  
                    '&datefrom=' + this.query.datefrom + '&dateto=' + this.query.dateto + '&checkbelum=' + this.query.checkbelum +
                    '&checksudah=' + this.query.checksudah                    
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
        filters: {
            numberFormat(value) {
                if (parseInt(value)) {
                    value = parseInt(value);
                    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                } else {
                    return '0';
                }
            },
        },
        computed: {
            invalid: function () {
                return this.errorStatus;
            }
        },
    }

</script>
