
<?php 
$name = $this->router->fetch_class(); 
$role = 'admin'; 
?>

<nav class="nav-primary hidden-xs">
  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">MENU</div>
  <ul class="nav nav-main" data-ride="collapse">

   <?php foreach ($menu as $menus): ?>

    <?php if (@(!empty($menus['child']))): ?>
      <?php $active = (array_search($name, array_column($menus['child'], 'modules')) !== FALSE)?'active':''; ?>

        <li class="<?php echo $active ?>">
          <a href="#">
            <span class="pull-right text-muted">
              <i class="i i-circle-sm-o text"></i>
              <i class="i i-circle-sm text-active"></i>
            </span>
            <i class="<?= $menus['icon']?> icon">
            </i>
            <span class="font-bold"><?php echo $menus['label'] ?></span>
          </a>
          <ul class="nav dk">

            <?php foreach ($menus['child'] as $childMenus): ?>
              <?php $actived = (strpos(current_url(), $childMenus['url']) && $childMenus['modules'] == $name /*&& (str_replace(base_url('index.php').'/', '', current_url()) == $childMenus['url'])*/ )?'active':''; ?>

                <li class="<?php echo $actived ?>">
                  <a href="<?= base_url($childMenus['url'])?>" class="list_a auto">                                                        
                    <i class="<?= $childMenus['icon']?>"></i>
                    <span><?= $childMenus['label'] ?></span>
                  </a>
                </li>

            <?php endforeach ?>

          </ul>
        </li>


      <?php elseif($menus['url'] != ''): ?>
        <?php $actived = (strpos(current_url(), $menus['url']) && $menus['modules'] == $name /*&& (str_replace(base_url('index.php').'/', '', current_url()) == $menus['url'])*/ )?'active':''; ?>
          <li class="<?php echo $actived ?>">
            <a href="<?= base_url($menus['url'])?>">
              <i class="<?= $menus['icon']?> icon">
              </i>
              <span class="font-bold"><?= $menus['label']?></span>
            </a>
          </li>
      <?php endif ?>

    <?php endforeach ?>

  </ul>
</nav>