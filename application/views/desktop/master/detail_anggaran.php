<style media="all" type="text/css">
    .alignCenter { text-align: center; }
    .mini_width { width: 1px;text-align: center; }
    .action_width { width: 1px; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>APBDESA</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> Tahun Anggaran </td>
                                        <td><?php echo $data_utama->tahun; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Jenis </td>
                                        <td style='uppercase'><?php echo $data_utama->keterangan; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Kategori </td>
                                        <td><?php echo $data_utama->kategori; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Keterangan </td>
                                        <td><?php echo $data_utama->rincian; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Nominal </td>
                                        <td><?php echo 'Rp '.number_format($data_utama->nominal,2); ?></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div>
					<div class='row'>
						<div class="col-md-12" >
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo"></i>
                                        <span class="caption-subject font-red-sunglo bold">Rincian Anggaran</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_15_2" data-toggle="tab"> Sub Output </a>
                                            </li>
                                            <li>
                                                <a href="#tab_15_3" data-toggle="tab"> Output </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_15_2">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Sub Output </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $get_pagu = $this->Main_model->getSelectedData('sub_output a', 'a.*',array('md5(a.id_apbdes)'=>$this->uri->segment(2)))->result();
                                                        foreach ($get_pagu as $key => $value) {
                                                            echo'
                                                            <tr>
                                                                <td style="text-align: center;"> '.$no++.'. </td>
                                                                <td > '.$value->sub_output.' </td>
                                                                <td style="text-align: center;"> Rp '.number_format($value->nominal,2).' </td>
                                                            </tr>
                                                            ';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab_15_3">
                                                <table class="table table-striped table-bordered table-hover" id="tbl">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;" width="1%"> # </th>
                                                            <th style="text-align: center;"> Sub Output </th>
                                                            <th style="text-align: center;"> Output </th>
                                                            <th style="text-align: center;"> Nominal </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <script type="text/javascript" language="javascript" >
                                                    $(document).ready(function(){
                                                        $('#tbl').dataTable({
                                                            "order": [[ 0, "asc" ]],
                                                            "bProcessing": true,
                                                            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                                                            "ajax" : {
                                                                url:"<?= site_url('desktop/Master/json_output'); ?>",
                                                                data: {id_apbdes:<?php echo "'".$this->uri->segment(2)."'";?>}
                                                            },
                                                            "aoColumns": [
                                                                        { mData: 'number', sClass: "mini_width" },
                                                                        { mData: 'sub_output', sClass: "alignCenter" } ,
                                                                        { mData: 'output', sClass: "alignCenter" } ,
                                                                        { mData: 'nominal', sClass: "alignCenter" }
                                                                    ]
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."detail_apbdesa/".md5($data_utama->tahun); ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>