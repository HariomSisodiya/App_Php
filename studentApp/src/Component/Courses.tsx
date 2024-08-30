import { useEffect, useState } from "react";
import './Courses.css'; // Import the CSS for styling
import videosData from './VideoData.ts' // Adjust the path according to your project structure

// Define the type for video data
interface Video {
    id: string;
    title: string;
    description: string;
    url: string;
    category: string;
    duration: string;
}

export default function Courses() {
    // Define the state with the type of an array of Video
    const [data, setData] = useState<Video[]>([]);

    useEffect(() => {
        // Simulate fetching data from the JSON file
        setData(videosData.videos);
        console.log("heollo");
    }, []);

    return (
        <div className="course-index">
            <h1 className="text-center">Learning Videos</h1>
            {data.length > 0 ? (
                <div className="row mt-5">
                    {data.map((video , index) => (
                        <div className="col-md-4 mb-4" key={index}>
                            <div className="card d-flex flex-column">
                                <div className="card-body d-flex flex-column">
                                    <h5 className="card-title">{video.title}</h5>
                                    <p className="card-text">{video.description}</p>
                                    <p className="card-text"><strong>Category:</strong> {video.category}</p>
                                    <p className="card-text"><strong>Duration:</strong> {video.duration}</p>
                                    <div className="embed-responsive embed-responsive-16by9 mt-3">
                                        <iframe className="embed-responsive-item" src={video.url} allowFullScreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            ) : (
                <p className="text-center">No videos found.</p>
            )}
        </div>
    );
}
