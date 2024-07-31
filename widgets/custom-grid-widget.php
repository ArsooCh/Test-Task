<?php

class Custom_Grid_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'custom_grid_widget';
    }

    public function get_title()
    {
        return __('Shuffleable Grid Widget', 'custom-grid');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }
    public function get_categories()
    {
        return [ 'custom_widgets' ];
    }

    public function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [ 
                'label' => __('Content', 'custom-grid'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'images',
            [ 
                'label' => __('Images', 'custom-grid'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
                'description' => 'Add images to display in the grid with their categories.',
            ]
        );

        $this->add_control(
            'categories',
            [ 
                'label' => __('Categories', 'custom-grid'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'JPG,PNG,GIF,JPEG',
                'description' => 'Comma-separated list of categories for images.',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [ 
                'label' => __('Style', 'custom-grid'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_style',
            [ 
                'label' => __('Grid Style', 'custom-grid'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '/* Add custom grid styles here */',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $images = $settings['images'];
        $categories = explode(',', $settings['categories']);
        $categories = array_map('trim', $categories);

        function get_file_extension($url)
        {
            return pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        }

        echo '<div class="custom-grid-container">';
        echo '<div class="filter-buttons">';
        echo '<div class="filter-button"><button class="filter-btn" data-category="All">All</button></div>';
        foreach ($categories as $category) {
            echo '<div class="filter-button"><button class="filter-btn" data-category="' . esc_attr($category) . '">' . esc_html($category) . '</button></div>';
        }
        echo '</div>';
        echo '<div class="custom-grid">';
        $fixedImage = array_shift($images);
        $fixedCategory = get_file_extension($fixedImage['url']);
        echo '<div class="grid-item fixed-item" data-category="' . esc_attr($fixedCategory) . '">';
        echo '<img src="' . esc_url($fixedImage['url']) . '" alt="">';
        echo '<div class="number-overlay">1</div>';
        echo '</div>';
        shuffle($images);
        foreach ($images as $index => $image) {
            $imageCategory = get_file_extension($image['url']);
            echo '<div id="no-img-found" style="display:none"><h4>No images found for the selected category</h4></div>';
            echo '<div class="grid-item" data-category="' . esc_attr($imageCategory) . '">';
            echo '<img src="' . esc_url($image['url']) . '" alt="">';
            echo '<div class="number-overlay">' . ($index + 2) . '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
}
