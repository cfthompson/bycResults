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
	$(".divisionrow").remove();
	if (html === null) {
		update_submit();
		return;
	}
	var props = html.split("$$");

	var obj = $("#method > option[value='"+props[2]+"']");
	obj.prop('selected', true);
	$("#param1").val(props[3]);
	$("#param2").val(props[4]);

	var seriestypeid = props[0];
	var url = "json/divisions.php?seriestypeid="+seriestypeid;
	if ($("#raceid").length === 1) {
		var raceid = $("#raceid").val();
		url += "&raceid="+raceid;
	}
	$.getJSON(url, function(data) {
		var html = "";
		$.each(data, function(divid, div) {
			var starttime = div.starttime;
			var hm = starttime.substr(0, 2)+":"+starttime.substr(3, 2);
			html += '<tr class="divisionrow">'+
				'<th colspan="3">'+div.name+' Division:</th></tr>'+
				'<tr class="divisionrow"><th>Start Time:</th>'+
				'<td>'+
				'<input type="hidden" name="division['+divid+'][typeid]" value="'+div.typeid+'">'+
				'<input type="text" name="division['+divid+'][starthourminute]" value="'+hm+'">'+
				' (HH:MM)<td class="errormsg"></td>'+
				'</tr>'+
				'<tr class="divisionrow"><th>Course:</th>'+
				'<td><select class="course" name="division['+divid+'][course]"><option></option>';
			$("span.courseid").each(function() {
				var course_id = $(this).attr('id').split("_");
				var courseid = course_id[1];
				var content = $(this).html().split("$$");
				var coursenumber = content[0];
				var sel = (courseid === div.course) ? "selected " : "";
				html += '<option '+sel+'value="'+courseid+'">'+coursenumber+'</option>';
			});
			html += '</select></td>'+
				'<td class="errormsg"></td>'+
				'</tr>'+
				'<tr class="divisionrow"><th>Distance:</th>'+
				'<td><input readonly name="division['+divid+'][distance]" class="distance" value="'+div.distance+'"></td>'+
				'<td class="errormsg"></td>'+
				'</tr>';
		});
		$("#divisionheader").after(html);
		update_submit();
	});
}

function onchange_course() {
	var courseid = $("option:selected", this).val();
	var mydistance = $(this).parent().parent().next().find('.distance');
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
		$(".course").each(function() {
			if ($(this).val() === "") {
				disableit = true;
			}
		});
	}
	if (!disableit) {
		$(".distance").each(function() {
			if (parseFloat($(this).val()) === 0) {
				disableit=true;
			}
		});
	}
	$("#submit").prop("disabled", disableit);
}
$(function() {
	$("#seriesid").change(onchange_seriesid);
	$("table#race").on("change", "tbody tr td select.course", onchange_course);
	$("#seriesid").trigger('change');
});
