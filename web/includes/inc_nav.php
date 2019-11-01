<?php
    $navOutput = '';

    $navQ = "SELECT _id, parent_id, post_alt_title FROM er_posts WHERE post_type = 'page' AND parent_id = ?  AND post_status = 'live' AND menu_order > 0 ORDER BY menu_order";

    // First level
    $fetchNav = $pdo->prepare($navQ);
    $fetchNav->execute([1]);

    $nCount = 0;


    while ( $row = $fetchNav->fetch() ) {
        $nCount++;

        $navOutput .= '<li class="nav__item nv-'.$row['_id'].'"><a class="nav__link';
        if ( $row['_id'] == $post_id || (isset($parent_id) && $row['_id'] == $parent_id) ) {
            $navOutput .= ' nav__link--active ';
        }

        $href = buildPath($row['_id']);

        $navOutput .= '" href="'.$href.'">'.$row['post_alt_title'];

            // Second level
            $fetchNav2 = $pdo->prepare($navQ);
            $fetchNav2->execute([$row['_id']]);

            if ( $fetchNav2->rowCount() > 0 ) {
                $nSubCount = 0;
                $navOutput .= '<i class="nav__parent-icon fa fa-angle-down"></i></a><div class="__nav__group"><div class="nav__group">';


                while ( $row2 = $fetchNav2->fetch() ) {
                    $nSubCount++;
                    $href = buildPath($row2['_id']);
                    $navOutput .= '<a class="nav__group__link" href="'.$href.'"> '.$row2['post_alt_title'].'</a>';
                }


                $navOutput .= '</div></div>';
            } else {
                $navOutput .= '</a>';
            }


        $navOutput .= '</li>';

    }
 ?>
<nav id="nav">
    <div class="inner">
    <ul class="reset--list">
        <li class="nav__item nv-1<? if($post_id == 1) { ?> nav__link--active<? }?>"><a class="nav__link" href="/"><i class="fa fa-home"></i></a></li>
        <?=$navOutput;?>
    </ul>
    </div>
</nav>