import React, { Component } from 'react';
import {Map, GoogleApiWrapper, Marker, InfoWindow} from 'google-maps-react';
import axios from 'axios';

const mapStyle =  {
  width : '100%',
  height : '60vh',
  position : 'relative'
}

class HomeMap extends Component {
  constructor(props) {
    super(props);

    this.state = {
      markers : [],
      infowindows : [],
      selectedMarker : {},
      place : {
        name : "",
        travel_type : {
          name : ""
        }
      },
      info : false
    }

    this.getMarkers = this.getMarkers.bind(this);
    this.onMapClick = this.onMapClick.bind(this);
    this.onMarkerClick = this.onMarkerClick.bind(this);
  }

  componentDidMount() {
    this.getMarkers();
  }

  getMarkers() {
    axios.get('/api/markers').then(resp => this.setState({ markers : resp.data }));
  }

  onMarkerClick(props, marker) {
    // console.log(marker);
    this.setState({
      place : props,
      selectedMarker : marker,
      info : true
    })
  }

  onMapClick() {
    if (this.state.info) {
      this.setState({
        selectedMarker : {},
        info : false
      })
    }
  }

  render() {
    return (
      <div id="map" className="card o-hidden">
        <Map 
        google={this.props.google}
        zoom={13}
        style={{ width : '100%', height : '100%', position : 'relative', top : 0, left : 0, right : 0, bottom : 0 }}
        initialCenter={{lat: 1.4692688, lng : 124.8391552}}
        onClick={this.onMapClick}
        >
        {
          this.state.markers.map((marker, i) => (
            // <React.Fragment>
              <Marker title={marker.site_type.name} onClick={ (props, point) => this.onMarkerClick(marker, point)} name={marker.name} key={i} position={{ lat : parseFloat(marker.latitude), lng : parseFloat(marker.longitude) }} />
            // </React.Fragment>
          ))
          }
          <InfoWindow visible={this.state.info} marker={this.state.selectedMarker}>
            <div className="text-center">
              <h4 className="m-0">{this.state.place.name}</h4>
              <p className="m-0 small text-muted">{this.state.place.travel_type.name}</p>
              <p className="m-0">{this.state.place.address}</p>
            </div>
          </InfoWindow>
        </Map>
      </div>
    );
  }
}

// const Maps = () => (<HomeMap />)

export default GoogleApiWrapper({
  apiKey : 'AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY'
})(HomeMap);