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

function boat_onChange() {
	var id = $(this).val();
	$("#entryboat").val(id);
	$("#entrysail").val(id);
	var boatspan = $("#boat_"+id);
	var boatprops = boatspan.html().split("$$");
	// boatprops:
	// 0 = name
	// 1 = sail
	// 2 = model
	// 3 = phrf
	// 4 = length
	// 5 = rollerFurling
	$("#entrytype").html(boatprops[2]);
	$("#phrf").val(boatprops[3]);
	$("#rollerFurling").prop("checked", boatprops[5] == "1");
	var divid = "";
	var divname = "";
	$(".division").each(function() {
		var tmpdivid = $(this).prop("id").split("_")[1];
		var divprops = $(this).html().split("$$");
		// divprops:
		// 0 = name
		// 1 = starttime
		// 2 = minphrf
		// 3 = maxphrf
		// 4 = minlength
		// 5 = maxlength
		// TODO: Implement division splits by length and phrf
		if (divprops[2] != "") {
		} else if (divprops[3] != "") {
		} else if (divprops[4] != "") {
		} else if (divprops[5] != "") {
		} else {
			divid = tmpdivid;
			divname = divprops[0];
		}
	});
	if (divid == "") {
		entry_clearcalc();
		return;
	}
	$("#division").html(divname);
	$("#divisionid").val(divid);
	$("#finish").focus();
}

function timeToSeconds(time) {
	var h, m, s;
	if (/\d{6}/.test(time)) {
		h = parseInt(time.substr(0, 2));
		m = parseInt(time.substr(2, 2));
		s = parseInt(time.substr(4, 2));
	} else if (/\d{2}:\d{2}:\d{2}/.test(time)) {
		h = parseInt(time.substr(0, 2));
		m = parseInt(time.substr(3, 2));
		s = parseInt(time.substr(6, 2));
	}
	if (h < 0 || m < 0 || s < 0 ||
		h > 23 || m > 59 || s > 59) {
		return -1;
	}
	var result = (h * 3600) + (m * 60) + s;
	return result;
}

function entry_recalc() {
	var divisionid = $("#divisionid").val();
	var phrf = $("#phrf").val();
	var spin = $("#spinnaker").prop("checked");
	var furl = $("#rollerFurling").prop("checked");
	var finish = $("#finish").val();
	if (phrf == "" || divisionid == "") {
		entry_clearcalc();
		return false;
	}

	divisionid = parseInt(divisionid);
	phrf = parseInt(phrf);
	var starttime = "";
	$(".division").each(function() {
		var tmpdivid = parseInt($(this).prop("id").split("_")[1]);
		if (tmpdivid !== divisionid) return;
		var divprops = $(this).html().split("$$");
		// divprops:
		// 0 = name
		// 1 = starttime
		// 2 = minphrf
		// 3 = maxphrf
		// 4 = minlength
		// 5 = maxlength
		starttime = divprops[1];
	});
	var tstart = timeToSeconds(starttime);
	var tfinish = timeToSeconds(finish);
	if (tstart < 0 || tfinish < 0) {
		entry_clearcalc();
		return false;
	}
	var elapsed = tfinish - tstart;
	var t = elapsed;
	var h = parseInt(t/3600);
	t -= h*3600;
	var m = parseInt(t/60);
	t -= m*60;
	var s = t;

	var elapsedstr = ""+h+":";
	if (m < 10) elapsedstr += "0";
	elapsedstr += m+":";
	if (s < 10) elapsedstr += "0";
	elapsedstr += s;

	$("#elapsed").html(elapsedstr);
	var tcf = 800.0/(550.0 + phrf);
	var tcfspin = spin ? 0.0 : 0.04*tcf;
	var tcffurl = furl ? 0.02*tcf : 0.0; 
	tcf -= tcfspin + tcffurl;
	$("#tcf").html(tcf.toFixed(2));
	var corrected = elapsed * tcf;
	var r = corrected % 3600;
	h = (corrected - r)/3600;
	corrected = r;
	r = corrected % 60;
	m = ((corrected - r)/60).toFixed(0);
	if (m < 10) m = "0"+m;
	s = r.toFixed(2);
	if (s < 10) s = "0"+s;
	$("#corrected").html(""+h+":"+m+":"+s);
	$("#entry_submit").prop("disabled", false);
	return true;
}

function entry_clearcalc() {
	$("#elapsed").html("");
	$("#tcf").html("");
	$("#corrected").html("");
	$("#gap").html("");
	$("#entry_submit").prop("disabled", true);
}

function onEntrySubmit(event) {
	if (!entry_recalc()) {
		event.preventDefault();
		return;
	}
}

$(function() {
	$("#entrysail").change(boat_onChange);
	$("#entryboat").change(boat_onChange);
	var objs = $(".calcinput");
	objs.change(entry_recalc);
	$("#entry_submit").click(onEntrySubmit);
	$("#entrysail").trigger("change");
	entry_recalc();
});
