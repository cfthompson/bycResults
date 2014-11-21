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

function seriestype_change() {
	var seriesid = $("#seriesid").val();
	if (seriesid == null || seriesid == "") {
		var typename = $("option.seriestype:selected").html();
		$("#seriestypeprefix").html(typename);
	}
	var typeid = $("option.seriestype:selected").val();
	$("#defaultMethod").prop('disabled', typeid === null);
	var html = $("#seriestype_"+typeid).html();
	var spl = html === null ? ["","",""] : html.split("$$");
	$("#defaultMethod").val(spl[0]);
	$("#defaultParam1").val(spl[1]);
	$("#defaultParam2").val(spl[2]);
	$("#defaultMethod").prop('disabled', html === null);
	$("#defaultParam1, #defaultParam2").prop('disabled', spl[0] !== 'TOT');
}

function defaultMethod_change() {
	var method = $("#defaultMethod").val();
	$("#defaultParam1, #defaultParam2").prop('disabled', method !== 'TOT');
	var typeid = $("option.seriestype:selected").val();
	var html = $("#seriestype_"+typeid).html();
	var spl = html.split("$$");
	$("#defaultParam1").val(spl[1]);
	$("#defaultParam2").val(spl[2]);
}

$(function() {
	seriestype_change();
});
