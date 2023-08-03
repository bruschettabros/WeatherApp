import React from 'react';
import Enzyme, { shallow } from 'enzyme';
import Adapter from '@cfaester/enzyme-adapter-react-18';
import expect from 'expect';
import { jest } from '@jest/globals';
import DatePicker from '../components/DatePicker.jsx';

Enzyme.configure({ adapter: new Adapter() });

it('Tests that the <DatePicker/> renders', () => {
    const datePicker = shallow(<DatePicker date={new Date()} setDate={jest.fn()} />);
    expect(datePicker).toBeTruthy();
});