<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                NRB List
                                <br>
                                <small class="text-info align-left">Data NRB yang di upload harus sudah sesuai dengan
                                    tabel terlampir</small>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-info" @click="newModal">
                                    <i class="fa fa-file-import"></i>
                                    Import
                                </button>
                                <button type="button" class="btn btn-success">
                                    <i class="fa fa-file-excel"></i>
                                    Export
                                </button>
                                <br><br>
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
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
                                        <th>Tgl Retur</th>
                                        <th>No. Faktur</th>
                                        <th>Amount (Rp.)</th>
                                        <th>No. Draf Retur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Alexander Pierce</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>Bob Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-primary">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Mike Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-danger">Denied</span></td>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>Jim Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Victoria Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>Michael Doe</td>
                                        <td>11-7-2014</td>
                                        <td><span class="tag tag-primary">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Getting Data, Please wait..</td>
                                    </tr>
                                </tbody>
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
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
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
                data: {},
                form: new Form(),
            }
        },
        methods: {
            loadData() {
                axios.get("api/nrb").then(({
                    data
                }) => (this.data = data.data));
            },
            handleScroll: function(e) {
                console.log(e.srcElement.scrollHeight - e.srcElement.scrollTop);
                console.log(e.srcElement.clientHeight);
		    },
            newModal() {
                this.form.reset();
                $('#addNew').modal('show');
            },

        },
        mounted() {},
        created() {
            this.$Progress.start();
            this.loadData();
            this.$Progress.finish();
        },
        filters: {},
        computed: {},
    }

</script>
