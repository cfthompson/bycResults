/* 
 * Copyright (C) 2014 rfgunion.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */

function onchange_seriesid() {
	var seriesid = $("#seriesid option:selected").val();
	var html = $("#series_"+seriesid).html();
	var props = html.split("$$");
	var seriestypeid = props[0];
	$.getJSON("json/divisiontypes.php?seriestypeid="+seriestypeid, function(data) {
		var divs = [];
		$.each(data, function(divid, div) {
			divs.push("<li id='"+divid+"'>"+
					"<dl><dt>name</dt><dd>"+div.name+"</dd>"+
					"<dt>defaultstarttime</dt><dd>"+div.defaultstarttime+"</dd>"+
					"<dt>minphrf</dt><dd>"+div.minphrf+"</dd>"+
					"<dt>maxphrf</dt><dd>"+div.maxphrf+"</dd>"+
					"<dt>minlength</dt><dd>"+div.minlength+"</dd>"+
					"<dt>maxlength</dt><dd>"+div.maxlength+"</dd>"+
					"</dl></li>");
		});
		$("<ul/>", {
			"class": "division",
			html: divs.join("")
		}).appendTo("body");
	});
}

function onchange_course() {
	var courseid = $("#course option:selected").val();
	if (courseid == "") {
		$("#distance").val("");
		$("#distance").prop("disabled", true);
		return;
	}
	var html = $("#course_"+courseid).html();
	var props = html.split("$$");
	var distance = props[1];
	var obj = $("#distance");
	obj.val(distance);
	obj.prop("disabled", distance > 0);
}

$(function() {
	$("#seriesid").change(onchange_seriesid);
	$("#course").change(onchange_course);
});
