	<table id="tblujian" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Periode</th>
				<th>Tanggal</th>
				<th>Tipe Ujian</th>
				<th>Mata Kuliah</th>
				<th>Pengawas</th>
				<th>Pilihan</th>
				</tr>
			</thead>
		<tbody>
											<?php if($ujian): foreach($ujian as $row): 
											$kode = $row->kode_matakuliah;
											$per = $row->id_periode; ?>
											<tr>
												<td>
													<?php $getPer = $this->my_lib->get_data('master_periode',array('id_periode'=>$per)); ?>
													<?php foreach($getPer as $p): ?>
													<b><?=$p->bulan.' '.$p->tahun?></b>
													<?php endforeach; ?>
												</td>
												<td><?=$row->tanggal?></td>
												<td style="text-transform: uppercase;"><?=$row->tipe?></td>
												<td><?=field_value('master_matakuliah','kode_matakuliah',$kode,'nama_matakuliah');?></td>
												<td>
												<?php $peng = $this->my_lib->get_data('data_ujian_pengawas',array('id_ujian'=>$row->id_ujian));
												if ($peng) { ?>
													<ul>
													<?php foreach ($peng as $pe) { ?>
														<li><?=$pe->nip?></li>
												<?php	} ?>
												 	</ul>
												<?php } else { ?>
													Belum di input
												<?php } ?>
												</td>
												<td align="center">
													<a class="btn btn-success btn-xs item_edit" onclick="edit_ujian(<?=$row->id_ujian?>)" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil"></i> Edit</a>
													<a class="btn btn-danger btn-xs item_hapus" onclick="del_ujian(<?=$row->id_ujian?>)" data-toggle="modal" data-target="#DelUnit"><i class="fa fa-trash"></i> Hapus</a>
												</td>
											</tr>
											<?php endforeach; endif; ?>
										</tbody>
	</table>