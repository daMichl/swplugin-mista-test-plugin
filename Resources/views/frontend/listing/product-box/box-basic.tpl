{extends file='parent:frontend/listing/product-box/box-basic.tpl'}

{block name='frontend_listing_box_article_description'}
    {$smarty.block.parent}

    {if $sArticle.my_attribute}
        ✅
    {else}
        ❌
    {/if}

{/block}
