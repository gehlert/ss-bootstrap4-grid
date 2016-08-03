<p>(ContentBlock)</p>
<% if $ClassName != "ContentBlock" %>
    <div class="$CSSClasses">
        $renderWith($ClassName)
    </div>
<% else %>
    $Content
<% end_if %>