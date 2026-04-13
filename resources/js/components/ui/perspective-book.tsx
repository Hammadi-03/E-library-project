"use client";

import React from "react";

const sizeMap = {
  sm: { width: "150px", depth: "25px" },
  default: { width: "196px", depth: "30px" },
  lg: { width: "260px", depth: "38px" },
};

interface PerspectiveBookProps {
  size?: "sm" | "default" | "lg";
  className?: string;
  coverImage?: string;
  title?: string;
  color?: string;
}

export function PerspectiveBook({
  size = "default",
  className = "",
  coverImage,
  title = "Book",
  color = "#1e3a8a",
}: PerspectiveBookProps) {
  const { width, depth } = sizeMap[size];

  return (
    <div
      className={`group [perspective:900px] w-min h-min cursor-pointer ${className}`}
    >
      <div
        style={{
          width,
          borderRadius: "6px 4px 4px 6px",
          transformStyle: "preserve-3d",
          aspectRatio: "2/3",
          position: "relative",
        }}
        className="[transform:rotateY(0deg)_rotateX(0deg)] transition-transform duration-500 ease-out group-hover:[transform:rotateY(-20deg)_rotateX(3deg)_scale(1.05)] group-hover:-translate-y-1"
      >
        {/* Front Cover */}
        <div
          style={{
            position: "absolute",
            inset: 0,
            transform: `translateZ(${depth})`,
            borderRadius: "4px 4px 4px 6px",
            overflow: "hidden",
            boxShadow: "6px 6px 20px rgba(0,0,0,0.5)",
          }}
        >
          {/* Spine highlight */}
          <div
            style={{
              position: "absolute",
              left: 0,
              top: 0,
              height: "100%",
              width: "12px",
              background:
                "linear-gradient(90deg, rgba(0,0,0,0.3), transparent 60%, rgba(255,255,255,0.1) 80%, transparent)",
              zIndex: 2,
            }}
          />
          {/* Sheen overlay */}
          <div
            style={{
              position: "absolute",
              inset: 0,
              background:
                "linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 50%, rgba(0,0,0,0.1) 100%)",
              zIndex: 3,
              pointerEvents: "none",
            }}
          />
          {coverImage ? (
            <img
              src={coverImage}
              alt={title}
              style={{ width: "100%", height: "100%", objectFit: "cover", display: "block" }}
            />
          ) : (
            <div
              style={{
                width: "100%",
                height: "100%",
                background: color,
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                padding: "16px",
              }}
            >
              <span style={{ color: "white", fontWeight: 800, fontSize: "14px", textAlign: "center" }}>
                {title}
              </span>
            </div>
          )}
        </div>

        {/* Spine */}
        <div
          style={{
            position: "absolute",
            top: 0,
            left: 0,
            height: "100%",
            width: depth,
            transform: `rotateY(-90deg) translateX(-${depth})`,
            transformOrigin: "left center",
            background: `linear-gradient(to right, ${color}dd, ${color})`,
            borderRadius: "6px 0 0 6px",
            boxShadow: "-4px 0 10px rgba(0,0,0,0.4)",
          }}
        />

        {/* Back */}
        <div
          style={{
            position: "absolute",
            inset: 0,
            transform: `translateZ(-${depth})`,
            background: color,
            borderRadius: "4px",
          }}
        />

        {/* Pages (side) */}
        <div
          style={{
            position: "absolute",
            top: "2px",
            right: `-${depth}`,
            bottom: "2px",
            width: depth,
            background:
              "repeating-linear-gradient(to right, #f5f5f0, #f5f5f0 1px, #e8e6e0 1px, #e8e6e0 2px)",
            transform: "rotateY(90deg)",
            transformOrigin: "left center",
          }}
        />
      </div>
    </div>
  );
}
