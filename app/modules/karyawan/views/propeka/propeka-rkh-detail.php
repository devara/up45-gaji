					<table class="table table-striped table-bordered">
	      		<thead>
							<tr>
								<th rowspan="2" class="text-center" style="vertical-align: middle;">No</th>
								<th rowspan="2" class="text-center" style="vertical-align: middle;">Kegiatan</th>
								<th colspan="2" class="text-center" style="vertical-align: middle;">Rencana (jam)</th>
							</tr>
							<tr>
								<th class="text-center">Dari</th>
								<th class="text-center">Sampai</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($detail as $row): ?>
								<tr>
									<td><?=$no?></td>
									<td><?=$row->kegiatan?></td>
									<td align="center"><?=$row->dari?></td>
									<td align="center"><?=$row->sampai?></td>
								</tr>
							<?php $no++; endforeach; ?>
						</tbody>
	      	</table>