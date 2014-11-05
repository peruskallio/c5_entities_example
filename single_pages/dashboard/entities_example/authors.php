<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (is_object($author)) : ?>
    <div class="ccm-dashboard-header-buttons">
        <?php echo $interface->button(t("Authors List"), $view->action(''), 'right') ?>
    </div>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th><?php echo t('Name') ?></th>
                <td><?php echo $author->name ?></td>
            </tr>
            <tr>
                <th><?php echo t('Number of Books') ?></th>
                <td><?php echo $author->getNumberOfBooks() ?></td>
            </tr>
            <tr>
                <th><?php echo t('Books Written by This Author') ?></th>
                <td>
                    <?php foreach ($author->books as $book) : ?>
                        <div><a href="<?php echo View::url('/dashboard/entities_example/books/', $book->bookID) ?>"><?php echo $book->name ?></a></div>
                    <?php endforeach; ?>
                </td>
            </tr>
        </tbody>
    </table>

<?php elseif (sizeof($authors) > 0) : ?>

<div class="ccm-dashboard-content-full">
    <div class="table-responsive">
        <table class="ccm-search-results-table">
            <thead>
                <tr>
                    <th><span><?php echo t("Name") ?></span></th>
                    <th><span><?php echo t("Number of Books") ?></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><a href="<?php echo $view->action($author->authorID) ?>"><?php echo $author->name ?></a></td>
                    <td><?php echo $author->getNumberOfBooks() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php else : ?>
    
    <p><?php echo t("No authors available.") ?></p>
    
<?php endif; ?>
