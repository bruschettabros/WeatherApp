import React from 'react';
import Enzyme, { shallow } from 'enzyme';
import Adapter from '@cfaester/enzyme-adapter-react-18';
import expect from 'expect';
import LatLonPicker from '../components/LatLonPicker.jsx';
import { jest } from '@jest/globals';

Enzyme.configure({ adapter: new Adapter() });

it('Tests that the <LatLonPicker/> renders', () => {
    const latLongPicker = shallow(<LatLonPicker
        lat={50}
        lon={-1}
        setLat={jest.fn()}
        setLon={jest.fn()} />,
    );
    expect(latLongPicker).toBeTruthy();
});

it('Tests that the <LatLonPicker/> updated lat and lon', () => {
    const setLat = jest.fn();
    const setLon = jest.fn();
    const latLongPicker = shallow(<LatLonPicker
        lat={50}
        lon={-1}
        setLat={setLat}
        setLon={setLon} />,
    );

    const latInput = latLongPicker.find('#lat-input');
    latInput.simulate('change', { target: { value: 52 } });
    expect(setLat).toHaveBeenCalledWith(52);

    const lonInput = latLongPicker.find('#lon-input');
    latInput.simulate('change', { target: { value: 10 } });
    expect(setLat).toHaveBeenCalledWith(10);

});