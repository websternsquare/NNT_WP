<article>
    <header>{{the_title(null, null, false)}}</header>
    <div>
        {!!the_content()!!}
        {!!wp_link_pages( array('echo' => false))!!}
    </div>

    <footer>
        @include('views.partials.author-bio')
        {{edit_post_link('Edit')}}
    </footer>
</article>