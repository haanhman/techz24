<?php
$row = $data['row'];
?>
<div class="row">
    <div class="twelve columns">
        <section id="maincontainer">
            <!-- Side Left Main Conten Area -->
            <div class="eight columns">
                <div id="content">
                    <section id="singlepost">
                        <header>
                            <h1><?php echo $row['title'] ?></h1>
                        </header>
                        <article>
                            <div class="post-content">
                                <?php echo $row['content'] ?>
                                <?php
                                if (SHOW_SOURCE) {
                                    echo '<p style="text-align: right">Source: <strong>' . $data['source'][$row['source_id']] . '</strong></p>';
                                }
                                ?>
                            </div>
                            <div class="clear"></div>
                        </article>
                    </section>
                </div>
            </div>

            <div class="four columns">
                <aside>
                    <!-- widget video  -->
                    <?php $this->widget('VideoWidget'); ?>

                    <!-- widget custome menus -->
                    <?php $this->widget('CategoryWidget'); ?>
                </aside>
            </div>
        </section>
    </div>
</div>