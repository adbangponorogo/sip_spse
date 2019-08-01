<div class="col-md-12">
    <div class="card dasboard-kategori-tender">
        <div class="card-header">
            <h4>TENDER BERDASARKAN KATEGORI TAHUN 2012 - 2019</h4>
        </div>
        <div class="card-block">
            <table class="dashboard-kategori-tender-table table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th width="75%">Kategori Tender</th>
                        <th class="hidden-xs" width="25%">Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    //*****************************************************
    //*                                             
    //* TENDER BERDASARKAN KATEGORI TAHUN 2012-2019
    //*                                             
    //*****************************************************

    // *///////////////////////////////////////////
    // * 
    // * ------- Data Kategori Tender -------
    // *
    // *///////////////////////////////////////////

    function refresh_dashboard_kategori_tender(tahun){
        create_dashboard_kelompok_tender(tahun);
    }

    create_dashboard_kelompok_tender(jQuery(".dashboard-pencarian-data").val());

    function data_dashboard_kelompok_tender(tahun){
        var data = null;
        jQuery.ajax({
          type      : 'AJAX',
          method    : 'GET',
          url       : '../dashboard/data/kelompok-tender/data-kategori/'+tahun,
          async     : false,
          dataType  : 'JSON',
          success   : function(JSON){
            data = JSON;
          },
          error     : function(jqXHR, textStatus, errorThrown){
            console.log("error");
          }
        });
        return data;
    }

    function create_dashboard_kelompok_tender(tahun){
        var get_data = data_dashboard_kelompok_tender(tahun);
        var data = [];
        for (var i = 0; i < get_data.length; i++) {
            data[i] = [get_data[i].kategori, get_data[i].jml_paket];
        }
        jQuery(".dashboard-kategori-tender-table").DataTable({
            destroy         : true,
            processing      : true,
            lengthMenu      : [10],
            dom             : 'Bfrtip',
            buttons         : {
                                buttons : [
                                            {
                                                extend : 'copy',
                                                text : '<i class="fa fa-copy"></i>&nbsp;Salin Data',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'csv',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to CSV',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'excel',
                                                text : '<i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'pdf',
                                                text : '<i class="fa fa-file-pdf-o"></i>&nbsp;Export to PDF',
                                                className : 'btn btn-success'
                                            },
                                            {
                                                extend : 'print',
                                                text : '<i class="fa fa-print"></i>&nbsp;Print Table',
                                                className : 'btn btn-success'
                                            },
                                          ]
                              },
            data            : data
        });
    }
</script>