<%-- apply default page rendering and render all grid components afterwards --%>
$renderWith('Layout/Page')

<% loop allChildren %>
    $renderWith($ClassName)
<% end_loop %>
