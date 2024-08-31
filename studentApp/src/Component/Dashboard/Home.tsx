import { useEffect, useState } from "react";
import axios from "axios";
import videosData from "../VideoData.ts";

interface Video {
  id: string;
  title: string;
  description: string;
  category: string;
  url: string;
}

export default function Home() {
  const [count, setCount] = useState<Video[]>([]);
  const [cCount, setCCount] = useState<number>(0); 

  useEffect(() => {
    setCount(videosData.videos);
  }, []);

  useEffect(() => {
    axios.get('http://localhost:8080/count')
      .then((response) => {
        setCCount(response.data);
      })
      .catch((err) => {
        console.error('Error in course count' , err);
      });
  }, []);

  return (
    <>
      <div className="container w-75 m-0 mt-3 me-3 p-5">
        <h1 className="text-center p-3 fw-bold" style={{ boxShadow: '0 0 4px 4px rgba(0, 0, 0, 0.2)' }}>
          Dashboard
        </h1>

        <div className="row mt-5 d-flex justify-content-evenly">
          <div
            className="col-md-4 bg-info text-white d-flex flex-column align-items-center p-5"
            style={{ boxShadow: '0 4px 8px rgba(0, 0, 0, 0.8)', borderRadius: "10px" }}
          >
            <h1>Student</h1>
            <h3>{cCount}</h3>
          </div>
          <div
            className="col-md-4 bg-primary text-white p-5 d-flex flex-column align-items-center"
            style={{ boxShadow: '0 4px 8px rgba(0, 0, 0, 0.8)', borderRadius: "10px" }}
          >
            <h1>Course</h1>
            <h3>{count.length}</h3>
          </div>
        </div>
      </div>
    </>
  );
}
