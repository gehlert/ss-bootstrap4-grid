(ContentRow)
<h2>$Title</h2>
<% loop allChildren %>
    $renderWith('ContentBlock')
<% end_loop %>
