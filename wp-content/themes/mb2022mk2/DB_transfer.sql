UPDATE wp_options SET option_value = replace(option_value, 'http://mb-polylang.test', 'https://mb2020.design.pawelwnuk.pl') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = replace(post_content, 'http://mb-polylang.test', 'https://mb2020.design.pawelwnuk.pl');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://mb-polylang.test','https://mb2020.design.pawelwnuk.pl');
UPDATE wp_usermeta SET meta_value = replace(meta_value, 'http://mb-polylang.test','https://mb2020.design.pawelwnuk.pl');
UPDATE wp_links SET link_url = replace(link_url, 'http://mb-polylang.test','https://mb2020.design.pawelwnuk.pl');
UPDATE wp_comments SET comment_content = replace(comment_content , 'http://mb-polylang.test','https://mb2020.design.pawelwnuk.pl');