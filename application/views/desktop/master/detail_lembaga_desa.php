<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Tentang Desa</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Lembaga Desa</span>
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
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width='17%'> Nama Lembaga </td>
                                        <td><?php echo $data_utama->nama; ?></td>
                                    </tr>
                                    <tr>
                                        <td width='17%'> Keterangan </td>
                                        <td><?php if($data_utama->keterangan=='' OR $data_utama->keterangan==NULL){echo'-';}else{echo $data_utama->keterangan;}?></td>
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
                                        <i class="icon-users font-red-sunglo"></i>
                                        <span class="caption-subject font-red-sunglo bold">Daftar Anggota</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;" width="1%"> # </th>
                                                <th style="text-align: center;"> Nama </th>
                                                <th style="text-align: center;"> Jabatan </th>
                                                <th style="text-align: center;"> Foto </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $getdata = $this->Main_model->getSelectedData('anggota_lembaga_desa a', 'a.*',array('md5(a.id_lembaga_desa)'=>$this->uri->segment(2)))->result();
                                            foreach ($getdata as $key => $value) {
                                                $foto = '';
                                                if($value->foto=='' OR $value->foto==NULL){
                                                    $foto = '';
                                                }else{
                                                    $foto = '<img src="'.base_url().'data_upload/anggota_lembaga_desa/'.$value->foto.'" width="100px" height="150px"/>';
                                                }
                                                echo'
                                                <tr>
                                                    <td style="text-align: center;"> '.$no++.'. </td>
                                                    <td style="text-align: left;"> '.$value->nama.' </td>
                                                    <td style="text-align: center;"> '.$value->jabatan.' </td>
                                                    <td style="text-align: center;"> '.$foto.' </td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."lembaga_desa"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>