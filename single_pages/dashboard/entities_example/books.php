<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (is_object($book)) : ?>
    <div class="ccm-dashboard-header-buttons">
        <?php echo $interface->button(t("Books List"), $view->action(''), 'right') ?>
    </div>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th><?php echo t('Name') ?></th>
                <td><?php echo $book->name ?></td>
            </tr>
            <tr>
                <th><?php echo t('ISBN') ?></th>
                <td><?php echo $book->getISBNFormatted() ?></td>
            </tr>
            <tr>
                <th><?php echo t2('Author', 'Authors', $book->getNumberOfAuthors()) ?></th>
                <td>
                    <?php foreach ($book->authors as $author) : ?>
                        <div><a href="<?php echo View::url('/dashboard/entities_example/authors/', $author->authorID) ?>"><?php echo $author->name ?></a></div>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo t('Showing Page') ?></th>
                <td><?php echo $pageNumber . ' / ' . $pagesTotal ?></td>
            </tr>
            <tr>
                <th><?php echo t('Words on Current Page') ?></th>
                <td><?php echo $page->getWordCount() ?></td>
            </tr>
        </tbody>
    </table>

    <p><?php echo nl2br($page->text) ?></p>

    <div class="ccm-search-results-pagination">
        <ul class="pagination">
            <?php if ($prevPage) : ?>
            <li class="prev"><a href="<?php echo $this->action($book->bookID, $prevPage) ?>">← Previous</a></li>
            <?php else : ?>
            <li class="prev disabled"><span>← Previous</span></li>
            <?php endif; ?>
            <?php if ($nextPage) : ?>
            <li class="next"><a href="<?php echo $this->action($book->bookID, $nextPage) ?>">Next →</a></li>
            <?php else : ?>
            <li class="next disabled"><span>Next →</span></li>
            <?php endif; ?>
        </ul>
    </div>

<?php elseif (sizeof($books) > 0) : ?>

<div class="ccm-dashboard-content-full">
    <div class="table-responsive">
        <table class="ccm-search-results-table">
            <thead>
                <tr>
                    <th><span><?php echo t("Name") ?></span></th>
                    <th><span><?php echo t("ISBN") ?></span></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><a href="<?php echo $view->action($book->bookID) ?>"><?php echo $book->name ?></a></td>
                    <td><?php echo $book->getISBNFormatted() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php else : ?>
    
    <p><?php echo t("No books available.") ?></p>
    
<?php endif; ?>
