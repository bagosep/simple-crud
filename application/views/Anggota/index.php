<?php
    $this->load->view("Layout/header.php");
?>
<div class="container">
	<div class="row justify-content-md-center">
        
		<div class="col-md-7" style="margin-top: 5%;">
	       
            <h3 class="box-title" style="float: left;">Data Anggota</h3>
            <button id="btnTambah" class="btn btn-primary" style="float: right;">Tambah Data</button>		      
		
			<table id="example" class="display nowrap" style="width:100%">
				<thead>
				    <tr>
				        <th>Nama</th>
				        <th>Tanggal Lahir</th>
				        <th>Alamat</th>
				        <th>Moto</th>
				        <th>Action</th>
				    </tr>
				</thead>
				<tbody>
					<?php
						foreach($data as $row){
			        ?>
				    <tr> 
				        <td><?php echo $row->nama; ?></td>
				        <td><?php echo $row->tanggal_lahir; ?></td>
				        <td><?php echo $row->alamat; ?></td>
				        <td><?php echo $row->moto; ?></td>
				        <td >
			           		<button class="btn btn-info m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill btnUpdate" 
			           		data-id="<?php echo $row->id_anggota ?>" 
			           		data-nama="<?php echo $row->nama ?>"
                            data-tangal_lahir="<?php echo $row->tanggal_lahir ?>"
                            data-alamat="<?php echo $row->alamat ?>"
                            data-moto="<?php echo $row->moto ?>" >

								<i class="fa fa-edit"></i>
							</button>
							<a href="<?php echo site_url('AnggotaController/delete/').$row->id_anggota; ?>" class="btn btn-danger m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill">
								<i class="fa fa-trash"></i>
							</a>
						</td>
				    </tr>
				    <?php
				    	}
				    ?>
				   
				   
				   
				</tbody>
				<!-- <tfoot>
				    <tr>
				        <th>Name</th>
				        <th>Position</th>
				        <th>Office</th>
				        <th>Start date</th>
				        <th>Salary</th>
				    </tr>
				</tfoot> -->
			</table>
		</div>
	</div>
</div>
<div class="modal fade in" id="input-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                </div>
            <div class="modal-body">
                <form class="form-horizontal">
                <input type="hidden" id="tipe" name="tipe">
                <input type="hidden" id="id_anggota" name="id_anggota">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Nama</label>
                            <div class="col-sm-12">
                            	
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Anda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Tanggal Lahir</label>
                            <div class="col-sm-12">
                                
                                <div class="input-group">
					                
					                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
					            
					            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Alamat</label>
                            <div class="col-sm-12">
                                
                                <div class="input-group">
                                    
                                    <textarea id="alamat" name="alamat" class="form-control">
                                    </textarea> 
                                
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Moto</label>
                            <div class="col-sm-12">
                                <div class="input-group">  
                                    <textarea id="moto" name="moto" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnSimpan" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="notification-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pemberitahuan</h4>
                    <button type="button" id="btnClose"class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    
                </div>
            <div class="modal-body">
                <label id="return" > </label>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnReload" class="btn btn-primary">Close</button>
            </div>
            </div>
        </div>
    </div>


<?php
    $this->load->view("Layout/footer.php");
?>
<script type="text/javascript">
    $( document ).ready(function(){
        var tipe;

        $('#btnTambah').click(function(){
            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .modal-title').text('Tambah Anggota');
            }

            $('#input-modal').modal('show');
            
        });

        $('.btnUpdate').click(function(){
            var data = $(this).data();
            
            $("#id_anggota").val(($.trim($( this ).attr('data-id'))));
            $("#nama").val(($.trim($( this ).attr('data-nama'))));
            $("#tanggal_lahir").val(($.trim($( this ).attr('data-tangal_lahir'))));
            $("#alamat").val(($.trim($( this ).attr('data-alamat'))));
            $("#moto").val(($.trim($( this ).attr('data-moto'))));
            

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .modal-title').text('Update Anggota');
            }

            $('#input-modal').modal('show');


            
        });

        $('#btnSimpan').click(function(e){
            tipe = $('#tipe').val();
            if (tipe == "insert"){
                insert(e);
            }

            if (tipe == "update"){
                update(e);
            }
        });

        $('#btnReload').click(function(){
            location.reload();
        });

        $('#btnClose').click(function(){
            location.reload();
        });
    });

    function insert(e){
        e.preventDefault();

        $.ajax({
            url: "<?php echo base_url() ?>AnggotaController/store",
            method: 'post',
            data: {
                nama: $('#nama').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                alamat: $('#alamat').val(),
                moto: $('#moto').val()
                
            },
            success: function(result){

                $('#return').text("Data berhasil ditambah");
                
                $('#input-modal').modal('hide');

                $('#notification-modal').modal("show");
            }
        });
    }

    function update(e){
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url() ?>AnggotaController/update",
                method: 'post',
                data: {
                    id_anggota: $('#id_anggota').val(),
                    nama: $('#nama').val(),
                    tanggal_lahir: $('#tanggal_lahir').val(),
                    alamat: $('#alamat').val(),
                    moto: $('#moto').val(),
                   
                },

                success: function(result){
                    $('#return').text("Data berhasil diupdate");
                    
                    $('#input-modal').modal('hide');

                    $('#notification-modal').modal("show");
                }

            });

        }
</script>

