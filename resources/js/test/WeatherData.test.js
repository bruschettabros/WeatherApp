import React from 'react';
import Enzyme, { shallow } from 'enzyme';
import Adapter from '@cfaester/enzyme-adapter-react-18';
import expect from 'expect';
import WeatherData from '../components/WeatherData.jsx';

Enzyme.configure({ adapter: new Adapter() });

it('Tests that the <WeatherData/> renders', () => {
    const weatherData = shallow(<WeatherData data={[]} loading />);
    expect(weatherData).toBeTruthy();
});