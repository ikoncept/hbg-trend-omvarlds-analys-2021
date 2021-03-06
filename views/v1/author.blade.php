@extends('templates.master')

@section('content')

@include('partials.archive-filters')

<div class="container main-container">
    <div class="grid">
        @if ($hasLeftSidebar || get_field('archive_' . sanitize_title($postType) . '_show_sidebar_navigation', 'option'))
            @include('partials.sidebar-left')
        @endif

        <?php
            $cols = 'grid-md-12';
            if (is_active_sidebar('right-sidebar') && get_field('archive_' . sanitize_title($postType) . '_show_sidebar_navigation', 'option')) {
                $cols = 'grid-md-8 grid-lg-6';
            } elseif (is_active_sidebar('right-sidebar') || get_field('archive_' . sanitize_title($postType) . '_show_sidebar_navigation', 'option')) {
                $cols = 'grid-md-8 grid-lg-9';
            } elseif ($hasLeftSidebar) {
                $cols = 'grid-md-8 grid-lg-9';
            }
        ?>

        <div class="{{ $cols }}">

            @if (is_active_sidebar('content-area-top'))
                <div class="grid grid--columns sidebar-content-area sidebar-content-area-top">
                    <?php dynamic_sidebar('content-area-top'); ?>
                </div>
            @endif

            <div class="grid">
                <div class="grid-xs-12">
                    <h2><?php _e('Posts by', 'municipio'); ?> {{ municipio_get_author_full_name() ? municipio_get_author_full_name() : get_the_author_meta('nicename') }}</h2>
                </div>
                @if (have_posts())
                    @while(have_posts())
                        {!! the_post() !!}

                        @if (in_array($template, array('full', 'compressed', 'collapsed', 'horizontal-cards')))
                            <div class="grid-xs-12 post">
                                @include('partials.blog.type.post-' . $template)
                            </div>
                        @else
                            @include('partials.blog.type.post-' . $template)
                        @endif
                    @endwhile
                @else
                    <div class="grid-xs-12">
                        <div class="notice info pricon pricon-info-o pricon-space-right"><?php _e('No posts to show'); ?>???</div>
                    </div>
                @endif
            </div>

            @if (is_active_sidebar('content-area'))
                <div class="grid grid--columns sidebar-content-area sidebar-content-area-bottom">
                    <?php dynamic_sidebar('content-area'); ?>
                </div>
            @endif

            <div class="grid">
                <div class="grid-sm-12 text-center">
                    {!!
                        paginate_links(array(
                            'type' => 'list'
                        ))
                    !!}
                </div>
            </div>
        </div>

        @include('partials.sidebar-right')
    </div>
</div>

@stop
