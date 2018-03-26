<p class="pagination-info pull-left"><?= $this->Paginator->counter(['format' => __('当前显示第{{page}}/{{pages}}页, 共{{count}}条记录')]) ?></p>
<ul class="pagination pagination-sm no-margin pull-right">
    <?= $this->Paginator->first('<< ' . __('首页')) ?>
    <?= $this->Paginator->prev('< ' . __('上一页')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('下一页') . ' >') ?>
    <?= $this->Paginator->last(__('尾页') . ' >>') ?>
</ul>