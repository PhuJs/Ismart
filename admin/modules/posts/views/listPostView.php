<?php
get_header();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=posts&controller=index&action=addPost" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count"><?php echo "({$num_row})"; ?></span></a> |</li>
                            <li class="pending"><a href="?mod=posts&controller=index&action=list_post_confirm">Chờ xét duyệt <span class="count"><?php echo "({$post_confirm})"; ?></span></a></li>
                            <li class="trash"><a href="?mod=posts&controller=index&action=post_in_trash">Thùng rác <span class="count"><?php echo "({$post_trash})"; ?></span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="key_search_post" id="s">
                            <input type="submit" name="btn_search_post" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <select name="" id="select_status_post">
                            <option value="0">Tác vụ</option>
                            <option value="1">Chờ xét duyệt</option>
                            <option value="2">Xét duyệt</option>
                            <option value="3">Bỏ vào thủng rác</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng" id="btn_update_status_post">
                    </div>
                    <?php
                    if (!empty($list_post)) {
                    ?>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = get_start_index($id, 6);
                                    foreach ($list_post as $item) {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem" class="check_item_post" data-id="<?php echo $item['post_id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $count; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=posts&controller=index&action=infor_post&id=<?php echo $item['post_id'];?>&map=<?php echo $id; ?>&act=1" title=""><?php echo substr($item['post_title'], 0, 80) . "..." ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=posts&controller=index&action=updatePost&id=<?php echo $item['post_id'];?>&map=<?php echo $id;?>&act=1" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=posts&controller=index&action=add_trash_post&id=<?php echo $item['post_id']?>&map=<?php echo $id;?>&act=1" title="Đưa vào thùng rác" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['cat_name']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo render_stt_posts($item['status_post']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['author']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $item['time']); ?></span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <div class="section" id="paging-wp">
                            <div class="section-detail clearfix">
                                <p id="desc" class="fl-left">Chọn vào checkbox trên cùng để lựa chọn tất cả</p>
                                <?php
                                // Thanh điều hướng
                                get_pagging($num_page, "?mod=posts&controller=index&action=listPost&id=", $id);
                                ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "Không có bài viết tồn tại";
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>