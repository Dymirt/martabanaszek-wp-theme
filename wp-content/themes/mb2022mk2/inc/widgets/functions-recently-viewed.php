<?php
function add_custom_widgets()
{
    register_widget('WC_Widget_Recently_Viewed_MB2020');
}

add_action('widgets_init', 'add_custom_widgets');

class WC_Widget_Recently_Viewed_MB2020 extends WC_Widget
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'woocommerce widget_recently_viewed_products';
        $this->widget_description = __("MB2020 Display a list of a customer's recently viewed products.", 'woocommerce');
        $this->widget_id = 'woocommerce_recently_viewed_products';
        $this->widget_name = __('Recent Viewed Products MB2020', 'woocommerce');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => __('Recently Viewed Products', 'woocommerce'),
                'label' => __('Title', 'woocommerce'),
            ),
            'number' => array(
                'type' => 'number',
                'step' => 1,
                'min' => 1,
                'max' => 15,
                'std' => 10,
                'label' => __('Number of products to show', 'woocommerce'),
            ),
        );

        parent::__construct();
    }

    /**
     * Output widget.
     *
     * @param array $args Arguments.
     * @param array $instance Widget instance.
     * @see WP_Widget
     */
    public function widget($args, $instance)
    {
        $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array)explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])) : array(); // @codingStandardsIgnoreLine
        $viewed_products = array_reverse(array_filter(array_map('absint', $viewed_products)));

        if (empty($viewed_products)) {
            return;
        }

        ob_start();

        $number = !empty($instance['number']) ? absint($instance['number']) : $this->settings['number']['std'];

        $query_args = array(
            'posts_per_page' => $number,
            'no_found_rows' => 1,
            'post_status' => 'publish',
            'post_type' => 'product',
            'post__in' => $viewed_products,
            'orderby' => 'post__in',
        );

        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'outofstock',
                    'operator' => 'NOT IN',
                ),
            ); // WPCS: slow query ok.
        }

        $r = new WP_Query(apply_filters('woocommerce_recently_viewed_products_widget_query_args', $query_args));

        if ($r->have_posts()) {

            $this->widget_start($args, $instance);

            echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<div id="infinite-scroll" class="container flex row" style="justify-content: space-between; margin: auto">'));

            while ($r->have_posts()) {
                $r->the_post();
                get_template_part('template-parts/content', 'post');
            }

            echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</div>'));

            $this->widget_end($args);
        }

        wp_reset_postdata();

        $content = ob_get_clean();

        echo $content; // WPCS: XSS ok.
    }
}
