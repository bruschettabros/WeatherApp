import PropTypes from "prop-types";
import React, { useState } from 'react';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

function WeatherData(props) {
    let date = new Date();
    date.setDate(date.getDate() - 1);
    return (
        <div className="col-md-6">
            <div className="card h-100">
                <div className="card-header">Select historic date</div>
                <div className="card-body">
                    <div className="input-group mb-3">
                        <div className="input-group-prepend">
                            <span className="input-group-text" id="date-input">Date</span>
                        </div>
                        <DatePicker
                            className={'form-control'}
                            selected={props.date}
                            maxDate={date}
                            onChange={(date) => props.setDate(date)}
                        />
                    </div>

                </div>
            </div>
        </div>
    );
}
WeatherData.propTypes = {
    date: PropTypes.object.isRequired,
    setDate: PropTypes.func.isRequired,
};

export default WeatherData;
