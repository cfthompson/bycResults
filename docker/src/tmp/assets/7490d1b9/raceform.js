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
	var method = $("#Races_method > option:selected").val();
	var disableParams = (method === 'TOD');
	$("#Races_param1").prop("disabled", disableParams);
	$("#Races_param2").prop("disabled", disableParams);
	if (disableParams) {
		$("#Races_param1").val("");
		$("#Races_param2").val("");
		return;
	}
	// For TOT, fill in default parameters
	var param1 = "";
	var param2 = "";
	var foundit = false;
	$(".seriestype").each(function() {
		if (foundit) return;
		var html = $(this).html();
		var props = html.split("$$");
		// props:
		// 0 = typeid
		// 1 = name
		// 2 = defaultMethod
		// 3 = defaultParam1
		// 4 = defaultParam2
		if (props[2] == method) {
			param1 = props[3];
			param2 = props[4];
			foundit = true;
		}
	});
	$("#Races_param1").val(param1);
	$("#Races_param2").val(param2);
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

function onchange_distance() {
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
			if (parseFloat($(this).val()) <= 0) {
				disableit=true;
			}
		});
	}
	$("#submit").prop("disabled", disableit);
}
$(function() {
	$("#Races_method").change(onchange_method);
	$("div.form").on("change", "select.course", onchange_course);
	$("div.form").on("change", "input.distance", onchange_distance);
	onchange_method();
	update_submit();
});
