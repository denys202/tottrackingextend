{assign var="vitedev" value=false}

{if $vitedev}
  <script type="module" src="http://localhost:8000/@vite/client"></script>
{else}
  <script type="module" crossorigin src="{$jsEntry}"></script>
    {foreach $jsBuild as $js}
      <link rel="modulepreload" href="{$js}">
    {/foreach}
    {foreach $cssBuild as $css}
      <link rel="stylesheet" href="{$css}">
    {/foreach}
{/if}

{if $vitedev}
  <script type="module" src="http://localhost:8000/src/front/js/main.ts"></script>
{/if}