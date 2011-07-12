body {
	width: 100%;
}
.elgg-main {
	padding: 10px 0 0;
}
.deck-river {
	/*padding: 10px 0 0;*/
}

.elgg-menu-deck-river {
	margin: 0;
}
.elgg-menu-deck-river > li {
	background-color: white;
}
.elgg-menu-deck-river > .elgg-state-selected {
	background-color: #EEE;
}
.elgg-menu-deck-river > .elgg-state-selected > a {
	background-color: #EEE;
}

.deck-river-lists {
	overflow-x: scroll;
	overflow-y: hidden;
	width: 100%;
}
.deck-river-lists .elgg-river {
	height: 100%;
	overflow-y: scroll;
}
.elgg-list {
	margin: 0;
}
.deck-river-lists .elgg-list > li {
	padding: 5px;
}
.column-river {
	float: left;
}
.column-river .column-header {
	cursor: move;
	height: 26px;
	background-color: #EEE;
	overflow: hidden;
	position: relative;
}
.column-river .column-header h3 {
	float: left;
	padding: 4px 45px 0 5px;
	color: #666;
}
.column-river .column-header > li a {
	position: absolute;
	top: 4px;
	display: inline-block;
	width: 18px;
	height: 18px;
}
.column-river .column-header > li a.elgg-column-refresh-button {
	right: 45px;
}
.column-river .column-header > li a.elgg-column-refresh-button .elgg-icon {
	height: 18px;
	width: 18px;
}
.column-river .column-header > li a.elgg-column-edit-button {
	right: 20px;
}

.elgg-river-item {
	padding: 0;
}
.elgg-river .elgg-module {
	margin-bottom: 0;
}
.elgg-river .elgg-ajax-loader {
	height: 100%;
}
.newRiverItem {
	display: none;
	border-right: 2px solid #4690D6;
}
.moreItem {
	background-color: #EEE;
	cursor: pointer;
	text-align: center;
}
.moreItem:hover {
	color: #4690D6;
}
.elgg-menu-river {
	opacity: 0;
}
.elgg-list-item:hover .elgg-menu-river {
	opacity: 1;
}
.elgg-river-comments-tab {
	float:left;
}
.elgg-river-comments li:first-child {
	border-radius: 0 5px 0 0;
}
.elgg-river-comments .elgg-output {
	margin-top: 0;
}
.elgg-river-item form {
	border-radius: 0 0 5px 5px;
}
.elgg-avatar-small > a > img {
	background-size: 32px !important;
	width: 32px;
	height: 32px;
	border-radius: 0;
}