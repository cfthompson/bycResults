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

function onchange_method() {
	var method = $("#method > option:selected").val();
	if (method !== 'TOT') {
		$("#param1").val("");
		$("#param2").val("");
		return;
	}
	// For TOT, fill in default parameters
	var seriesid = $("#seriesid option:selected").val();
	var html = $("#series_"+seriesid).html();
	if (html === null) {
		return;
	}
	var props = html.split("$$");
	// props:
	// 0 = typeid
	// 1 = name
	// 2 = defaultMethod
	// 3 = defaultParam1
	// 4 = defaultParam2
	$("#param1").val(props[3]);
	$("#param2").val(props[4]);
}

function onchange_course() {
	var courseid = $("option:selected", this).val();
	var id = $(this).attr('id');
	var idx = id.lastIndexOf('_courseid');
	var mydistance = $(this).parent().parent().find('input#'+id.substr(0, idx)+'_distance');
	if (courseid == "") {
		mydistance.val("");
		mydistance.prop("readonly", true);
		$("#submit").prop("disabled", true);
		return;
	}
	var html = $("#course_"+courseid).html();
	var props = html.split("$$");
	var distance = props[1];
	mydistance.val(distance);
	mydistance.prop("readonly", distance > 0);
	update_submit();
}

function update_submit() {
	var disableit = $("#seriesid option:selected").val() === "";

	if (!disableit) {
		$("select.course").each(function() {
			if ($(this).val() === "") {
				disableit = true;
			}
		});
	}
	if (!disableit) {
		$("input.distance").each(function() {
			if (parseFloat($(this).val()) === 0) {
				disableit=true;
			}
		});
	}
	$("#submit").prop("disabled", disableit);
}
$(function() {
	$("#Races_method").change(onchange_method);
	$("div.form").on("change", "select.course", onchange_course);
});
