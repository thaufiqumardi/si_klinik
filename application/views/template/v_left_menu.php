<?php
    $rolename = $this->session->userdata['simklinik']['ap_role_name'];
    $is_admin = $this->session->userdata['simklinik']['ap_is_admin'];
    $menus = $this->M_crud->get_select_to_array('m.id_menu', 'hak_akses as p','menu as m','p.hak_akses_menu = m.id_menu','p.hak_akses_role', $this->session->userdata['simklinik']['ap_role'], 'p.hak_akses_retrive', '1', 'm.id_menu');
    $listmenu = "";

    if(!empty($menus)){
    	foreach($menus as $item) {
    		$listmenu .= $item->id_menu.",";
    	}
    	$listmenu = rtrim($listmenu,",");
    }else{
    	$listmenu = "";
    }
?>

<div class="wrapper">
	<?php $this->load->view('template/v_top_menu'); ?>

	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="image" >
          			<img src="<?php echo base_url('logo/KMB_Logo.png');?>" alt="">
        		</div>
			</div>
			<ul class="sidebar-menu">
				<?php
					$mysql_query = "";

					if($is_admin == 1){
						$mysql_query = "select * from menu where parent = 0 order by urutan asc";
					}else if(!empty($listmenu)){
						$mysql_query = "select * from menu where id_menu in(".$listmenu.") and parent = 0 order by urutan asc";
					}

					if(!empty($mysql_query)){
						$query = $this->M_crud->_custom_query($mysql_query);
						foreach ($query->result() as $row){
							if($row->parent == 0){
								$count_child = $this->M_crud->count_where('menu', 'parent', $row->id_menu);
								if($count_child > 0){
								?>
									<li class="treeview" id="<?= $row->ref ?>">
										<a href="#">
		        							<i class="fa <?= $row->icon ?>"></i> <span><?= $row->title ?></span>
								            <span class="pull-right-container">
								              <i class="fa fa-angle-left pull-right"></i>
								            </span>
		        						</a>
		        						<ul class="treeview-menu">
		        							<?php
					        					if($is_admin == 1){
					        						$mysql_query_child = "select * from menu where parent = $row->id_menu order by urutan asc";
					        					}else if(!empty($listmenu)){
					        						$mysql_query_child = "select * from menu where id_menu in(".$listmenu.") and parent = $row->id_menu order by urutan asc";
					        					}
				        						$query_child = $this->M_crud->_custom_query($mysql_query_child);
				        						foreach ($query_child->result() as $row_child){
				        						?>
				        							<li id="<?= $row_child->ref ?>">
										              <a href="<?php echo base_url().$row_child->url; ?>">
										                <i class="fa <?= $row_child->icon ?>"></i> <?= $row_child->title ?>
										              </a>
										            </li>
				        						<?php
				        						}
				        					?>
		        						</ul>
									</li>
								<?php
								}else{
								?>
									<li id="<?= $row->ref ?>">
          								<a href="<?php echo base_url().$row->url;?>"><i class="fa <?= $row->icon ?>"></i> <?= $row->title ?></a>
        							</li>
								<?php
								}
							}
						}
					}
				?>
			</ul>
		</section>
	</aside>
</div>
