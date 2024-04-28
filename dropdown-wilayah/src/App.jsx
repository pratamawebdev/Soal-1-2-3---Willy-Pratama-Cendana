import { useEffect } from "react";
import "./App.css";
import getData from "./api/getData";
import { useState } from "react";

function App() {
  const [provinces, setProvinces] = useState([]);
  const [cities, setCities] = useState([]);
  const [cityId, setCityId] = useState("");
  const [provinceId, setProvinceId] = useState("");
  const [districts, setDistricts] = useState([]);
  const [villages, setVillages] = useState([]);
  const [districtId, setDistrictId] = useState("");

  useEffect(() => {
    const fetchDataProvince = async () => {
      try {
        const response = await getData("/provinces.json");
        setProvinces(response.data);
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    };

    fetchDataProvince();
  }, []);

  const handleChangeProvince = (e) => {
    const getProvinceId = e.target.value;
    setProvinceId(getProvinceId);
  };

  const handleChangeCity = (e) => {
    const getCityId = e.target.value;
    setCityId(getCityId);
  };

  const handleChangeDistrict = (e) => {
    const getDistrictId = e.target.value;
    setDistrictId(getDistrictId);
  };

  useEffect(() => {
    const fetchDataCities = async () => {
      try {
        const response = await getData(`/regencies/${provinceId}.json`);
        setCities(response.data);
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    };

    fetchDataCities();
  }, [provinceId]);

  useEffect(() => {
    const fetchDataDistricts = async () => {
      try {
        const response = await getData(`/districts/${cityId}.json`);
        setDistricts(response.data);
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    };

    fetchDataDistricts();
  }, [cityId, provinceId]);

  useEffect(() => {
    const fetchDataVillages = async () => {
      try {
        const response = await getData(`/villages/${districtId}.json`);
        setVillages(response.data);
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    };

    fetchDataVillages();
  }, [districtId, cityId, provinceId]);

  return (
    <>
      <div className="app">
        <select
          name="province"
          id="province"
          onChange={(e) => handleChangeProvince(e)}
        >
          <option value="">Pilih Provinsi</option>
          {provinces.map((province) => (
            <option key={province.id} value={province.id}>
              {province.name}
            </option>
          ))}
        </select>
        <select name="cities" id="cities" onChange={(e) => handleChangeCity(e)}>
          <option value="">Pilih Kota</option>
          {cities.map((city) => (
            <option key={city.id} value={city.id}>
              {city.name}
            </option>
          ))}
        </select>
        <select
          name="district"
          id="district"
          onChange={(e) => handleChangeDistrict(e)}
        >
          <option value="">Pilih Kecamatan</option>
          {districts.map((district) => (
            <option key={district.id} value={district.id}>
              {district.name}
            </option>
          ))}
        </select>
        <select name="villages" id="villages">
          <option value="">Pilih Kelurahan</option>
          {villages.map((village) => (
            <option key={village.id} value={village.id}>
              {village.name}
            </option>
          ))}
        </select>
      </div>
    </>
  );
}

export default App;
