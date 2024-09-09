<?php
/**
 * CSortableLinkColumn class file.
 *
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

Yii::import('zii.widgets.grid.CLinkColumn');

/**
 * CSortableLinkColumn represents a grid view column that renders a hyperlink in each of its data cells.
 *
 * See CLinkColumn for details about setting up this class.  In addition, to enable sorting the name property
 * must be set and correspond to one of the fields in the CActiveDataProvider.  This works similarly to
 * CDataColumn.
 *
 * @author Bob Gunion <bob.gunion@gmail.com>
 * @version $Id$
 */
class CSortableLinkColumn extends CLinkColumn {

	/**
	 * @var string the attribute name of the data model. The corresponding attribute value will be rendered
	 * in each data cell. If {@link value} is specified, this property will be ignored
	 * unless the column needs to be sortable or filtered.
	 * @see value
	 * @see sortable
	 */
    public $name;
    
	/**
	 * @var boolean whether the column is sortable. If so, the header cell will contain a link that may trigger the sorting.
	 * Defaults to true. Note that if {@link name} is not set, or if {@link name} is not allowed by {@link CSort},
	 * this property will be treated as false.
	 * @see name
	 */
    public $sortable = true;
    /**
     * @var mixed the HTML code representing a filter input (eg a text field, a dropdown list)
     * that is used for this column. This property is effective only when
     * {@link CGridView::enableFiltering} is set true.
     * If this property is not set, a text field will be generated as the filter input;
     * If this property is an array, a dropdown list will be generated that uses this property value as
     * the list options.
     * If you don't want a filter for this data column, set this value to false.
     * Copied from {@link CDataColumn::filter}
     */
    public $filter;
    public $filterHtmlOptions = array();
	/**
	 * Initializes the column.
	 */
	public function init()
	{
		parent::init();
		if($this->name===null)
			$this->sortable=false;
    }
    
    /**
     * Renders the header cell content.
     * This method will render a link that can trigger the sorting if the column is sortable.
     */
    protected function renderHeaderCellContent()
    {
        if($this->grid->enableSorting && $this->sortable && $this->name!==null)
            echo $this->grid->dataProvider->getSort()->link($this->name,$this->header);
        else if($this->name!==null && $this->header===null)
        {
            if($this->grid->dataProvider instanceof CActiveDataProvider)
                echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
            else
                echo CHtml::encode($this->name);
        }
        else
            parent::renderHeaderCellContent();
    }
    
    /**
     * Renders the filter cell content.
     * This method will render the {@link filter} as is if it is a string.
     * If {@link filter} is an array, it is assumed to be a list of options, and a dropdown selector will be rendered.
     * Otherwise if {@link filter} is not false, a text field is rendered.
     * Copied from {@link CDataColumn::renderFilterCellContent()}
     */
    protected function renderFilterCellContent()
    {
        if(is_string($this->filter))
            echo $this->filter;
        else if($this->filter!==false && $this->grid->filter!==null && $this->name!==null && strpos($this->name,'.')===false)
        {
            if(is_array($this->filter))
                echo CHtml::activeDropDownList($this->grid->filter, $this->name, $this->filter, array('id'=>false,'prompt'=>''));
            else if($this->filter===null) {
				$options = array_merge(
					array('id'=>false),
					$this->filterHtmlOptions);
                echo CHtml::activeTextField($this->grid->filter, $this->name, $options);
			}
        }
        else
            parent::renderFilterCellContent();
    }
    
}