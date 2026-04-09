import React from "react";
import { Book } from "./ui/book";

interface Book3DWrapperProps {
  title: string;
  color?: string;
  textured?: boolean;
  variant?: "simple" | "stripe";
}

const Book3DWrapper: React.FC<Book3DWrapperProps> = ({ title, color, textured, variant }) => {
  return (
    <div className="flex justify-center py-2">
      <Book 
        title={title} 
        color={color} 
        textured={textured} 
        variant={variant} 
        width={{ sm: 140, md: 160, lg: 180 }}
      />
    </div>
  );
};

export default Book3DWrapper;
