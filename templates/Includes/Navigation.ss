<nav class="navbar navbar-light bg-faded">
  <div class="nav navbar-nav">
		<% loop $Menu(1) %>
			<a class="nav-item nav-link <% if LinkOrSection = section %>active<% end_if %>" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
		<% end_loop %>
  </div>
</nav>