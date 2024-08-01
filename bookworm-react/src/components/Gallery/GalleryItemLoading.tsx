import Forward from "components/icons/Forward";

const GalleryItemLoading = () => {

    return (
        <div className={`GalleryItem Loading`}>
            <div className='image'>
                <div className="loadingGradient">
                    <Forward />
                </div>
            </div>
        </div>
    )
}

export default GalleryItemLoading;