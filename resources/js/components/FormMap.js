import React, { Component, Fragment } from 'react';
import {Map, GoogleApiWrapper, Marker} from 'google-maps-react';

export class FormMap extends Component {
  constructor(props) {
    super(props);

    this.state = {position : {lat: 1.4692688, lng : 124.8391552}}

    this.geocode = this.geocode.bind(this);
  }

  markerMove(a, b) {
    const {lat,lng} = b.position;
    this.props.onCoordChange({latitude : b.position.lat(), longitude : b.position.lng()});
    this.geocode(lat(), lng());
  }

  geocode(lat, lng) {
    console.log(lat, lng)
    let geocode = new this.props.google.maps.Geocoder;
    geocode.geocode({location : {lat, lng}}, (res) => this.props.address(res[0].formatted_address))
  }

  componentWillReceiveProps(props) {
    // const {lat, lng} = props.position;
    // const position = new this.props.google.maps.LatLng(lat, lng);
    // console.log(position);
    // this.props.map.setCenter(position);
  }
  
  render() {
    return (
      <Fragment>
        <div className="card" style={{ height : '60vh' }}>
          <Map 
          google={this.props.google}
          zoom={15}
          style={{ width : '100%', height : '100%', position : 'relative' }}
          initialCenter={this.state.position}
          center={this.props.position}
          >
            <Marker position={this.props.position} draggable={true} onDragend={this.markerMove.bind(this)} />
          </Map>
        </div>
      </Fragment>
    )
  }
}

export default GoogleApiWrapper({
  apiKey : 'AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY'
})(FormMap);
