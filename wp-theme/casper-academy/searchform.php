<form role="search" method="get" class="bsearch" action="<?= esc_url(home_url('/')) ?>">
  <label class="screen-reader-text" for="bsearch-<?= esc_attr(wp_unique_id()) ?>">Search the blog</label>
  <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
  <input type="search" name="s" value="<?= esc_attr(get_search_query()) ?>" placeholder="Search articles">
</form>
