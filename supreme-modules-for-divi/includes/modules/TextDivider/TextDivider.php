<?php

class DSM_Text_Divider extends ET_Builder_Module {

	public $slug       = 'dsm_text_divider';
	public $vb_support = 'on';
	public $icon_path;

	protected $module_credits = array(
		'module_uri' => 'https://divisupreme.com/',
		'author'     => 'Divi Supreme',
		'author_uri' => 'https://divisupreme.com/',
	);

	public function init() {
		$this->name             = esc_html__( 'Supreme Text Divider', 'supreme-modules-for-divi' );
		$this->icon_path        = plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->main_css_element = '%%order_class%%.dsm_text_divider';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'supreme-modules-for-divi' ),
					'visibility'   => esc_html__( 'Visibility', 'supreme-modules-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'color'  => esc_html__( 'Color', 'supreme-modules-for-divi' ),
					'styles' => esc_html__( 'Styles', 'supreme-modules-for-divi' ),
				),
			),
		);

		$style_option_name    = sprintf( '%1$s-divider_style', $this->slug );
		$global_divider_style = ET_Global_Settings::get_value( $style_option_name );

		$this->defaults = array(
			'divider_style' => $global_divider_style && '' !== $global_divider_style ? $global_divider_style : 'solid',
		);

	}

	public function get_advanced_fields_config() {
		return array(
			'fonts'          => array(
				'header' => array(
					'label'          => esc_html__( 'Divider', 'supreme-modules-for-divi' ),
					'css'            => array(
						'main' => "{$this->main_css_element} .dsm-text-divider-header, {$this->main_css_element} .dsm-text-divider-header a",
					),
					'font_size'      => array(
						'default' => '22px',
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'header_level'   => array(
						'default' => 'h3',
					),
				),
			),
			'borders'        => array(
				'default' => false,
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'           => array(
				'use_background_layout' => true,
				'use_text_orientation'  => false,
				'css'                   => array(
					'text_shadow' => "{$this->main_css_element}",
				),
				'options'               => array(
					'background_layout' => array(
						'default_on_front' => 'light',
					),
				),
			),
			'button'         => false,
		);
	}

	public function get_fields() {
		return array(
			'header'           => array(
				'label'            => esc_html__( 'Divider Text', 'supreme-modules-for-divi' ),
				'type'             => 'text',
				'option_category'  => 'basic_option',
				'description'      => esc_html__( 'The text of divider will appear in between the divider.', 'supreme-modules-for-divi' ),
				'toggle_slug'      => 'main_content',
				'default_on_front' => 'Divider Text',
				'dynamic_content'  => 'text',
			),
			'text_alignment'   => array(
				'label'           => esc_html__( 'Text Alignment', 'supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'left'   => esc_html__( 'Left', 'supreme-modules-for-divi' ),
					'center' => esc_html__( 'Center', 'supreme-modules-for-divi' ),
					'right'  => esc_html__( 'Right', 'supreme-modules-for-divi' ),
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'default'         => 'center',
			),
			'color'            => array(
				'default'     => et_builder_accent_color(),
				'label'       => esc_html__( 'Color', 'supreme-modules-for-divi' ),
				'type'        => 'color-alpha',
				'tab_slug'    => 'advanced',
				'description' => esc_html__( 'This will adjust the color of the 1px divider line.', 'supreme-modules-for-divi' ),
				'toggle_slug' => 'color',
			),
			'divider_style'    => array(
				'label'           => esc_html__( 'Divider Style', 'supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => et_builder_get_border_styles(),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'styles',
				'default'         => $this->defaults['divider_style'],
			),
			'divider_position' => array(
				'label'           => esc_html__( 'Divider Position', 'supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'flex-start' => esc_html__( 'Top', 'supreme-modules-for-divi' ),
					'center'     => esc_html__( 'Vertically Centered', 'supreme-modules-for-divi' ),
					'flex-end'   => esc_html__( 'Bottom', 'supreme-modules-for-divi' ),
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'styles',
				'default'         => 'center',
			),
			'divider_weight'   => array(
				'label'           => esc_html__( 'Divider Weight', 'supreme-modules-for-divi' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'width',
				'default_unit'    => 'px',
				'default'         => '1px',
			),
			'text_gap'         => array(
				'label'           => esc_html__( 'Text Gap', 'supreme-modules-for-divi' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'width',
				'default_unit'    => 'px',
				'default'         => '10px',
			),
			'height'           => array(
				'label'            => esc_html__( 'Height', 'supreme-modules-for-divi' ),
				'type'             => 'range',
				'option_category'  => 'layout',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'width',
				'description'      => esc_html__( 'Define how much space should be added below the divider.', 'supreme-modules-for-divi' ),
				'default'          => '23px',
				'default_unit'     => 'px',
				'default_on_front' => '23px',
			),
		);
	}

	public function get_alignment() {
		$alignment = isset( $this->props['align'] ) ? $this->props['align'] : '';

		return et_pb_get_alignment( $alignment );
	}

	public function render( $attrs, $content, $render_slug ) {
		$multi_view        = et_pb_multi_view_options( $this );
		$header            = $this->props['header'];
		$text_alignment    = $this->props['text_alignment'];
		$color             = $this->props['color'];
		$height            = $this->props['height'];
		$divider_style     = $this->props['divider_style'];
		$divider_position  = $this->props['divider_position'];
		$divider_weight    = $this->props['divider_weight'];
		$text_gap          = $this->props['text_gap'];
		$header_level      = $this->props['header_level'];
		$background_layout = $this->props['background_layout'];

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		// Module classnames
		$header = $multi_view->render_element(
			array(
				'content' => '{{header}}',
			)
		);

		if ( '' !== $header ) {
			$header = sprintf(
				'<%1$s class="dsm-text-divider-header et_pb_module_header">%2$s</%1$s>',
				et_pb_process_header_level( $header_level, 'h3' ),
				et_core_esc_previously( $header )
			);
		}

		if ( '' !== $color ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-divider',
					'declaration' => sprintf(
						'border-top-color: %1$s;',
						esc_html( $color )
					),
				)
			);
		}

		if ( '' !== $divider_style ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-divider',
					'declaration' => sprintf(
						'border-top-style: %1$s;',
						esc_attr( $divider_style )
					),
				)
			);
		}

		if ( '' !== $divider_weight ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-divider',
					'declaration' => sprintf(
						'border-top-width: %1$s;',
						esc_attr( $divider_weight )
					),
				)
			);
		}

		if ( '10px' !== $text_gap ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-text-divider-header',
					'declaration' => sprintf(
						'margin: 0 %1$s;',
						esc_attr( $text_gap )
					),
				)
			);
		}

		if ( 'left' === $text_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-text-divider-header',
					'declaration' => sprintf(
						'margin: 0 %1$s 0 0;',
						esc_attr( $text_gap )
					),
				)
			);
		}

		if ( 'right' === $text_alignment ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-text-divider-header',
					'declaration' => sprintf(
						'margin: 0 0 0 %1$s;',
						esc_attr( $text_gap )
					),
				)
			);
		}

		if ( 'center' !== $divider_position ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-text-divider-wrapper',
					'declaration' => sprintf(
						'align-items: %1$s;',
						esc_attr( $divider_position )
					),
				)
			);
		}

		if ( '' !== $height ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% .dsm-text-divider-wrapper',
					'declaration' => sprintf(
						'height: %1$s;',
						esc_attr( et_builder_process_range_value( $height ) )
					),
				)
			);
		}

		$class = "dsm-text-divider-wrapper dsm-text-divider-align-{$text_alignment} et_pb_bg_layout_{$background_layout}";

		// Render module content.
		$output = sprintf(
			'<div%3$s class="%2$s">
				%5$s
				%4$s
				<div class="dsm-text-divider-before dsm-divider"></div>
				%1$s
				<div class="dsm-text-divider-after dsm-divider"></div>
			</div>',
			$header,
			esc_attr( $class ),
			$this->module_id(),
			$video_background,
			$parallax_image_background
		);

		if ( isset( get_option( 'dsm_settings_misc' )['dsm_dynamic_assets'] ) && ! empty( get_option( 'dsm_settings_misc' )['dsm_dynamic_assets'] ) && 'on' === get_option( 'dsm_settings_misc' )['dsm_dynamic_assets'] ) {
			if ( isset( get_option( 'dsm_settings_misc' )['dsm_dynamic_assets_compatibility'] ) && ! empty( get_option( 'dsm_settings_misc' )['dsm_dynamic_assets'] ) && 'on' === get_option( 'dsm_settings_misc' )['dsm_dynamic_assets_compatibility'] ) {
				wp_enqueue_style( 'dsm-text-divider', plugin_dir_url( __DIR__ ) . 'TextDivider/style.css', array(), DSM_VERSION, 'all' );
			} else {
				add_filter( 'et_global_assets_list', array( $this, 'dsm_load_required_divi_assets' ), 10, 3 );
				add_filter( 'et_late_global_assets_list', array( $this, 'dsm_load_required_divi_assets' ), 10, 3 );
			}
		}

		return $output;
	}

	/**
	 * Force load global styles.
	 *
	 * @param array $assets_list Current global assets on the list.
	 *
	 * @return array
	 */
	public function dsm_load_required_divi_assets( $assets_list, $assets_args, $instance ) {
		$assets_prefix     = et_get_dynamic_assets_path();
		$all_shortcodes    = $instance->get_saved_page_shortcodes();
		$this->_cpt_suffix = et_builder_should_wrap_styles() && ! et_is_builder_plugin_active() ? '_cpt' : '';

		if ( ! isset( $assets_list['et_jquery_magnific_popup'] ) ) {
			$assets_list['et_jquery_magnific_popup'] = array(
				'css' => "{$assets_prefix}/css/magnific_popup.css",
			);
		}

		if ( ! isset( $assets_list['et_pb_overlay'] ) ) {
			$assets_list['et_pb_overlay'] = array(
				'css' => "{$assets_prefix}/css/overlay{$this->_cpt_suffix}.css",
			);
		}

		// TextDivider.
		if ( ! isset( $assets_list['dsm_text_divider'] ) ) {
			$assets_list['dsm_text_divider'] = array(
				'css' => plugin_dir_url( __DIR__ ) . 'TextDivider/style.css',
			);
		}

		return $assets_list;
	}
}

new DSM_Text_Divider();
